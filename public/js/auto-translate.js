/**
 * Auto-translate dynamic content from Hebrew to Russian/English
 * Uses a dictionary for common terms + basic transliteration
 */

var DICT = {
    ru: {
        // Female Names
        'אלנה': 'Елена', 'לנה': 'Елена', 'נטליה': 'Наталия', 'אולגה': 'Ольга',
        'יקטרינה': 'Екатерина', 'ויקטוריה': 'Виктория', 'אנה': 'Анна',
        'אינסטסיה': 'Анастасия', 'מריה': 'Мария', 'אירינה': 'Ирина',
        'טטיאנה': 'Татьяна', 'סבטלנה': 'Светлана', 'יוליה': 'Юлия',
        'אלינה': 'Алина', 'דיאנה': 'Диана', 'קסניה': 'Ксения',
        'ולריה': 'Валерия', 'דריה': 'Дарья', 'סופיה': 'София',
        // Male Hebrew Names (for reviews)
        'דוד': 'Давид', 'יוסי': 'Йоси', 'משה': 'Моше', 'יואב': 'Йоав',
        'רן': 'Ран', 'גיא': 'Гай', 'אלון': 'Алон', 'אודי': 'Уди',
        'דני': 'Дани', 'ישראל': 'Исраэль', 'אבי': 'Ави', 'יעקב': 'Яаков',
        'אהרון': 'Аарон', 'נועם': 'Ноам', 'עומר': 'Омер', 'איתי': 'Итай',
        'איתן': 'Этан', 'רון': 'Рон',
        // Last names
        'כהן': 'Коэн', 'לוי': 'Леви', 'מזרחי': 'Мизрахи', 'שלום': 'Шалом',
        'אברהם': 'Авраам', 'ברקוביץ': 'Беркович', 'פרץ': 'Перец',
        'ביטון': 'Битон', 'דהאן': 'Дахан', 'אוחיון': 'Охайон',
        'הלוי': 'а-Леви', 'חזן': 'Хазан', 'כץ': 'Кац',
        // Review/testimonial phrases
        'השירות היה מקצועי ויוצא דופן. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.':
            'Сервис был профессиональным и исключительным. Команда помогла мне найти настоящую любовь. Рекомендую каждому серьёзному мужчине.',
        'צוות מקצועי ואנושי. לוו אותי בכל שלב בתהליך. היום אני מאושר עם האישה הנפלאה שלי ממולדובה.':
            'Профессиональная и человечная команда. Сопровождали меня на каждом этапе. Сегодня я счастлив с прекрасной женой из Молдовы.',
        'דיסקרטיות מוחלטת, מקצועיות בלי פשרות. הכל בוצע בצורה מדויקת. תודה ענקית על הליווי!':
            'Полная конфиденциальность, бескомпромиссный профессионализм. Всё сделано точно. Огромное спасибо за сопровождение!',
        'הרבה מעבר למה שציפיתי. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.':
            'Намного больше, чем я ожидал. Команда помогла мне найти настоящую любовь. Рекомендую каждому серьёзному мужчине.',
        'טיול מאורגן למולדובה, פגישות עם נשים מדהימות, וליווי צמוד. שירות ברמה הגבוהה ביותר!':
            'Организованная поездка в Молдову, встречи с удивительными женщинами, близкое сопровождение. Сервис на высочайшем уровне!',
        'אחרי 3 חודשים מצאתי את האחת. השירות שלהם איכותי, מסור ויחס אישי. תוכנית ה-VIP שווה כל שקל!':
            'Через 3 месяца я нашёл ту самую. Их сервис качественный, преданный, индивидуальный подход. VIP-программа стоит каждой копейки!',
        'השירות מעבר למה שציפיתי. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.':
            'Сервис превзошёл ожидания. Команда помогла найти настоящую любовь. Рекомендую каждому серьёзному мужчине.',
        'הרבה מעבר למה שציפיתי': 'Намного больше, чем я ожидал',
        'ממליץ בחום': 'Горячо рекомендую',
        'השירות היה מקצועי': 'Сервис был профессиональным',
        'לקוח מאומת': 'Верифицированный клиент',
        // Cities
        'קישינב': 'Кишинёв', 'קייב': 'Киев', 'אודסה': 'Одесса', 'טירספול': 'Тирасполь',
        'לבוב': 'Львов', 'בלץ': 'Бельцы', 'חרקוב': 'Харьков', 'דניפרו': 'Днепр',
        'תל אביב': 'Тель-Авив', 'ירושלים': 'Иерусалим', 'חיפה': 'Хайфа',
        // Countries
        'מולדובה': 'Молдова', 'אוקראינה': 'Украина', 'ישראל': 'Израиль',
        // Occupations
        'מעצבת פנים ואמנית': 'Дизайнер интерьеров и художница',
        'רופאת שיניים': 'Стоматолог', 'עורכת דין': 'Юрист',
        'מהנדסת תוכנה': 'Инженер-программист', 'מורה לפסנתר': 'Преподаватель фортепиано',
        'שפית': 'Шеф-повар', 'רואה חשבון': 'Бухгалтер', 'אחות': 'Медсестра',
        'מנהלת': 'Менеджер', 'מורה': 'Учительница', 'רופאה': 'Врач',
        'מעצבת אופנה': 'Модельер', 'פסיכולוגית': 'Психолог',
        // Education
        'תואר שני באדריכלות': 'Магистр архитектуры',
        'דוקטור לרפואת שיניים': 'Доктор стоматологии',
        'תואר ראשון במשפטים': 'Бакалавр юриспруденции',
        'תואר ראשון במדעי המחשב': 'Бакалавр компьютерных наук',
        'תואר שני במוזיקה': 'Магистр музыки',
        'בית ספר לקולינריה': 'Кулинарная школа',
        'תיכון מקצועי': 'Профессиональное училище',
        'תואר ראשון': 'Бакалавр', 'תואר שני': 'Магистр',
        // Languages
        'אנגלית': 'Английский', 'רוסית': 'Русский', 'רומנית': 'Румынский',
        'אוקראינית': 'Украинский', 'צרפתית': 'Французский', 'פולנית': 'Польский',
        'עברית': 'Иврит', 'גרמנית': 'Немецкий', 'ספרדית': 'Испанский',
        // Hobbies
        'טיולים': 'Путешествия', 'מוזיקה קלאסית': 'Классическая музыка',
        'אמנות': 'Искусство', 'יוגה': 'Йога', 'קריאה': 'Чтение',
        'בישול': 'Кулинария', 'ספורט': 'Спорт', 'נסיעות': 'Путешествия',
        'צילום': 'Фотография', 'טכנולוגיה': 'Технологии', 'מוזיקה': 'Музыка',
        'ריקוד': 'Танцы', 'ספרות': 'Литература', 'טבע': 'Природа',
        'אפייה': 'Выпечка', 'גינון': 'Садоводство', 'ריצה': 'Бег',
        'שחייה': 'Плавание', 'ציור': 'Рисование',
        // Marital
        'רווקה': 'Не замужем', 'גרושה': 'Разведена', 'אלמנה': 'Вдова',
        'נישואין רציניים': 'Серьёзные отношения',
        // Children
        'ללא': 'Нет', 'אין': 'Нет', 'יש': 'Есть',
        // Common
        'בת': '', 'גיל': 'Возраст',
        // Profile text patterns
        'אני נפש יצירתית שמוצאת יופי בפרטים הקטנים.': 'Я творческая натура, нахожу красоту в мелочах.',
        'אני מאמינה באהבה אמיתית ובמשפחה חמה.': 'Я верю в настоящую любовь и тёплую семью.',
        'אישה עצמאית ומצליחה שמחפשת שותף לחיים.': 'Успешная независимая женщина ищет спутника жизни.',
        'אני משלבת בין העולם הטכנולוגי ליופי הנשי.': 'Я сочетаю мир технологий с женской красотой.',
        'המוזיקה היא השפה שלי.': 'Музыка — мой язык.',
        'הדרך ללב עוברת דרך הבטן.': 'Путь к сердцу лежит через желудок.',
        'גבר בטוח בעצמו וסקרן': 'Уверенный и любознательный мужчина',
        'גבר רציני עם ערכי משפחה': 'Серьёзный мужчина с семейными ценностями',
        'שותף לחיים עם חוש הומור': 'Спутник жизни с чувством юмора',
        'גבר חכם ומשעשע': 'Умный и весёлый мужчина',
        'מישהו רגיש ואוהב תרבות': 'Чувствительный человек, любящий культуру',
        'גבר שמעריך אוכל טוב וחיי משפחה': 'Мужчина, ценящий хорошую еду и семью',
    },
    en: {
        // Female Names
        'אלנה': 'Elena', 'לנה': 'Elena', 'נטליה': 'Natalia', 'אולגה': 'Olga',
        'יקטרינה': 'Yekaterina', 'ויקטוריה': 'Victoria', 'אנה': 'Anna',
        'אינסטסיה': 'Anastasia', 'מריה': 'Maria', 'אירינה': 'Irina',
        'טטיאנה': 'Tatiana', 'סבטלנה': 'Svetlana', 'יוליה': 'Julia',
        'אלינה': 'Alina', 'דיאנה': 'Diana', 'קסניה': 'Ksenia',
        'ולריה': 'Valeria', 'דריה': 'Daria', 'סופיה': 'Sofia',
        // Male Hebrew Names (for reviews)
        'דוד': 'David', 'יוסי': 'Yossi', 'משה': 'Moshe', 'יואב': 'Yoav',
        'רן': 'Ran', 'גיא': 'Guy', 'אלון': 'Alon', 'אודי': 'Udi',
        'דני': 'Dani', 'ישראל': 'Israel', 'אבי': 'Avi', 'יעקב': 'Yaakov',
        'אהרון': 'Aharon', 'נועם': 'Noam', 'עומר': 'Omer', 'איתי': 'Itai',
        'איתן': 'Eitan', 'רון': 'Ron',
        // Last names
        'כהן': 'Cohen', 'לוי': 'Levi', 'מזרחי': 'Mizrahi', 'שלום': 'Shalom',
        'אברהם': 'Avraham', 'ברקוביץ': 'Berkovich', 'פרץ': 'Peretz',
        'ביטון': 'Biton', 'דהאן': 'Dahan', 'אוחיון': 'Ohayon',
        'הלוי': 'HaLevi', 'חזן': 'Hazan', 'כץ': 'Katz',
        // Review/testimonial phrases
        'השירות היה מקצועי ויוצא דופן. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.':
            'The service was professional and exceptional. The team helped me find true love. I recommend it to any serious man looking for a relationship.',
        'צוות מקצועי ואנושי. לוו אותי בכל שלב בתהליך. היום אני מאושר עם האישה הנפלאה שלי ממולדובה.':
            'A professional and caring team. They guided me through every step. Today I\'m happily married to my wonderful wife from Moldova.',
        'דיסקרטיות מוחלטת, מקצועיות בלי פשרות. הכל בוצע בצורה מדויקת. תודה ענקית על הליווי!':
            'Complete discretion, uncompromising professionalism. Everything was done precisely. Huge thanks for the support!',
        'הרבה מעבר למה שציפיתי. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.':
            'Far beyond my expectations. The team helped me find true love. I recommend it to any serious man looking for a relationship.',
        'טיול מאורגן למולדובה, פגישות עם נשים מדהימות, וליווי צמוד. שירות ברמה הגבוהה ביותר!':
            'Organized trip to Moldova, meetings with amazing women, and close personal support. Highest level of service!',
        'אחרי 3 חודשים מצאתי את האחת. השירות שלהם איכותי, מסור ויחס אישי. תוכנית ה-VIP שווה כל שקל!':
            'After 3 months I found "the one". Their service is high-quality, dedicated with personal attention. The VIP program is worth every penny!',
        'לקוח מאומת': 'Verified Client',
        'ממליץ בחום': 'Highly recommend',
        'הרבה מעבר למה שציפיתי': 'Far beyond my expectations',
        // Cities
        'קישינב': 'Chisinau', 'קייב': 'Kyiv', 'אודסה': 'Odessa', 'טירספול': 'Tiraspol',
        'לבוב': 'Lviv', 'בלץ': 'Balti', 'חרקוב': 'Kharkiv', 'דניפרו': 'Dnipro',
        'תל אביב': 'Tel Aviv', 'ירושלים': 'Jerusalem', 'חיפה': 'Haifa',
        // Countries
        'מולדובה': 'Moldova', 'אוקראינה': 'Ukraine', 'ישראל': 'Israel',
        // Occupations
        'מעצבת פנים ואמנית': 'Interior Designer & Artist',
        'רופאת שיניים': 'Dentist', 'עורכת דין': 'Lawyer',
        'מהנדסת תוכנה': 'Software Engineer', 'מורה לפסנתר': 'Piano Teacher',
        'שפית': 'Chef', 'רואה חשבון': 'Accountant', 'אחות': 'Nurse',
        'מנהלת': 'Manager', 'מורה': 'Teacher', 'רופאה': 'Doctor',
        'מעצבת אופנה': 'Fashion Designer', 'פסיכולוגית': 'Psychologist',
        // Education
        'תואר שני באדריכלות': 'Master\'s in Architecture',
        'דוקטור לרפואת שיניים': 'Doctor of Dentistry',
        'תואר ראשון במשפטים': 'Bachelor of Law',
        'תואר ראשון במדעי המחשב': 'Bachelor of Computer Science',
        'תואר שני במוזיקה': 'Master\'s in Music',
        'בית ספר לקולינריה': 'Culinary School',
        'תיכון מקצועי': 'Vocational School',
        'תואר ראשון': 'Bachelor\'s Degree', 'תואר שני': 'Master\'s Degree',
        // Languages
        'אנגלית': 'English', 'רוסית': 'Russian', 'רומנית': 'Romanian',
        'אוקראינית': 'Ukrainian', 'צרפתית': 'French', 'פולנית': 'Polish',
        'עברית': 'Hebrew', 'גרמנית': 'German', 'ספרדית': 'Spanish',
        // Hobbies
        'טיולים': 'Travel', 'מוזיקה קלאסית': 'Classical Music',
        'אמנות': 'Art', 'יוגה': 'Yoga', 'קריאה': 'Reading',
        'בישול': 'Cooking', 'ספורט': 'Sports', 'נסיעות': 'Travel',
        'צילום': 'Photography', 'טכנולוגיה': 'Technology', 'מוזיקה': 'Music',
        'ריקוד': 'Dance', 'ספרות': 'Literature', 'טבע': 'Nature',
        'אפייה': 'Baking', 'גינון': 'Gardening', 'ריצה': 'Running',
        'שחייה': 'Swimming', 'ציור': 'Painting',
        // Marital
        'רווקה': 'Single', 'גרושה': 'Divorced', 'אלמנה': 'Widowed',
        'נישואין רציניים': 'Serious Relationship',
        // Children
        'ללא': 'None', 'אין': 'None', 'יש': 'Yes',
        // Common
        'בת': '', 'גיל': 'Age',
        // Profile text patterns
        'אני נפש יצירתית שמוצאת יופי בפרטים הקטנים.': 'I\'m a creative soul who finds beauty in small details.',
        'אני מאמינה באהבה אמיתית ובמשפחה חמה.': 'I believe in true love and a warm family.',
        'אישה עצמאית ומצליחה שמחפשת שותף לחיים.': 'An independent, successful woman looking for a life partner.',
        'אני משלבת בין העולם הטכנולוגי ליופי הנשי.': 'I combine the world of technology with feminine beauty.',
        'המוזיקה היא השפה שלי.': 'Music is my language.',
        'הדרך ללב עוברת דרך הבטן.': 'The way to the heart is through the stomach.',
        'גבר בטוח בעצמו וסקרן': 'Confident and curious man',
        'גבר רציני עם ערכי משפחה': 'Serious man with family values',
        'שותף לחיים עם חוש הומור': 'Life partner with sense of humor',
        'גבר חכם ומשעשע': 'Smart and funny man',
        'מישהו רגיש ואוהב תרבות': 'Sensitive, culture-loving person',
        'גבר שמעריך אוכל טוב וחיי משפחה': 'Man who values good food and family life',
    }
};

/**
 * Transliterate Hebrew name to Latin/Cyrillic automatically
 * Used when name is not found in dictionary
 */
var HE_TO_EN = {'א':'a','ב':'b','ג':'g','ד':'d','ה':'h','ו':'v','ז':'z','ח':'kh','ט':'t','י':'i','כ':'k','ך':'k','ל':'l','מ':'m','ם':'m','נ':'n','ן':'n','ס':'s','ע':'a','פ':'p','ף':'f','צ':'ts','ץ':'ts','ק':'k','ר':'r','ש':'sh','ת':'t'};
var HE_TO_RU = {'א':'а','ב':'б','ג':'г','ד':'д','ה':'х','ו':'в','ז':'з','ח':'х','ט':'т','י':'и','כ':'к','ך':'к','ל':'л','מ':'м','ם':'м','נ':'н','ן':'н','ס':'с','ע':'а','פ':'п','ף':'ф','צ':'ц','ץ':'ц','ק':'к','ר':'р','ש':'ш','ת':'т'};

function transliterateName(name, lang) {
    if (!name) return name;
    var map = lang === 'ru' ? HE_TO_RU : HE_TO_EN;
    var result = '';
    for (var i = 0; i < name.length; i++) {
        var ch = name[i];
        if (map[ch]) {
            // Capitalize first letter of each word
            var mapped = map[ch];
            if (i === 0 || name[i-1] === ' ') {
                mapped = mapped.charAt(0).toUpperCase() + mapped.slice(1);
            }
            result += mapped;
        } else {
            result += ch;
        }
    }
    return result;
}

/**
 * Translate a Hebrew text string to target language
 */
function autoTranslate(text, lang, isName) {
    if (!text || !lang || lang === 'he') return text;
    var dict = DICT[lang] || {};

    // Try exact match first
    if (dict[text]) return dict[text];

    // If it's a name and not in dictionary, transliterate it
    if (isName && /[\u0590-\u05FF]/.test(text)) {
        return transliterateName(text, lang);
    }

    // Try translating comma-separated lists (like languages, hobbies)
    if (text.indexOf(',') > -1) {
        var parts = text.split(',').map(function(p) {
            var trimmed = p.trim();
            return dict[trimmed] || trimmed;
        });
        return parts.join(', ');
    }

    // Try partial replacements (longest match first)
    var keys = Object.keys(dict).sort(function(a, b) { return b.length - a.length; });
    var result = text;
    for (var i = 0; i < keys.length; i++) {
        if (result.indexOf(keys[i]) > -1) {
            result = result.split(keys[i]).join(dict[keys[i]]);
        }
    }

    // If still has Hebrew characters, try transliteration as last resort
    if (/[\u0590-\u05FF]/.test(result)) {
        result = transliterateName(result, lang);
    }

    return result;
}

/**
 * Translate profile object fields
 */
function translateProfile(p, lang) {
    if (!lang || lang === 'he') return p;
    var copy = Object.assign({}, p);
    if (copy.name) copy.name = autoTranslate(copy.name, lang, true);
    if (copy.city) copy.city = autoTranslate(copy.city, lang);
    if (copy.occupation) copy.occupation = autoTranslate(copy.occupation, lang);
    if (copy.education) copy.education = autoTranslate(copy.education, lang);
    if (copy.languages) copy.languages = autoTranslate(copy.languages, lang);
    if (copy.hobbies) copy.hobbies = autoTranslate(copy.hobbies, lang);
    if (copy.about) copy.about = autoTranslate(copy.about, lang);
    if (copy.looking_for) copy.looking_for = autoTranslate(copy.looking_for, lang);
    if (copy.children) copy.children = autoTranslate(copy.children, lang);
    if (copy.marital_status) {
        var ms = {'single': lang === 'ru' ? 'Не замужем' : 'Single', 'divorced': lang === 'ru' ? 'Разведена' : 'Divorced', 'widowed': lang === 'ru' ? 'Вдова' : 'Widowed'};
        copy.marital_status_display = ms[copy.marital_status] || copy.marital_status;
    }
    return copy;
}

/* =========================================================================
 * Server-backed auto-translation (MyMemory API via /api/translate, DB cached)
 * -------------------------------------------------------------------------
 * Strategy:
 *   1. DICT lookup (instant, hand-written)
 *   2. localStorage cache (instant, persists across sessions)
 *   3. Server /api/translate (async, caches in DB)
 *   4. Re-render DOM nodes whose text was translated
 *
 * Usage on a page after rendering dynamic content:
 *   applyRemoteTranslations(rootElement);
 * It scans [data-translate] attributes and fills each with the live language.
 * ======================================================================= */

var REMOTE_MEM = {};       // session cache: { "he|ru": { "שלום": "Привет" } }
var REMOTE_PENDING = {};   // inflight promises per key
var REMOTE_STORAGE_KEY = 'rd_tr_cache_v1';

(function loadRemoteStorage() {
    try {
        var raw = localStorage.getItem(REMOTE_STORAGE_KEY);
        if (raw) REMOTE_MEM = JSON.parse(raw) || {};
    } catch (e) { REMOTE_MEM = {}; }
})();

function saveRemoteStorage() {
    try { localStorage.setItem(REMOTE_STORAGE_KEY, JSON.stringify(REMOTE_MEM)); } catch (e) {}
}

function getRemoteCached(text, lang) {
    var bucket = REMOTE_MEM[lang];
    if (bucket && typeof bucket[text] === 'string') return bucket[text];
    return null;
}

function setRemoteCached(text, lang, value) {
    if (!REMOTE_MEM[lang]) REMOTE_MEM[lang] = {};
    REMOTE_MEM[lang][text] = value;
}

/** Translate multiple texts in a single API call; returns a Promise<{text: translation}> */
function remoteTranslateBatch(texts, lang) {
    texts = texts.filter(function (t) { return t && /[\u0590-\u05FF]/.test(t); });
    if (!texts.length || lang === 'he') return Promise.resolve({});
    var missing = [];
    var result = {};
    texts.forEach(function (t) {
        var cached = getRemoteCached(t, lang);
        if (cached !== null) result[t] = cached;
        else missing.push(t);
    });
    if (!missing.length) return Promise.resolve(result);
    var key = lang + '|' + missing.join('\u0001');
    if (REMOTE_PENDING[key]) return REMOTE_PENDING[key];
    REMOTE_PENDING[key] = fetch((window.BASE_URL || '') + '/api/translate', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ texts: missing, lang: lang })
    }).then(function (r) { return r.json(); }).then(function (data) {
        var tr = (data && data.translations) || {};
        Object.keys(tr).forEach(function (t) {
            setRemoteCached(t, lang, tr[t]);
            result[t] = tr[t];
        });
        saveRemoteStorage();
        delete REMOTE_PENDING[key];
        return result;
    }).catch(function () { delete REMOTE_PENDING[key]; return result; });
    return REMOTE_PENDING[key];
}

/**
 * Scan root for [data-translate] elements, translate them to current LANG,
 * and update their textContent. Cheap: batches all unknown strings in one call.
 */
function applyRemoteTranslations(root) {
    var lang = (typeof LANG !== 'undefined') ? LANG : 'he';
    if (lang === 'he') return;
    root = root || document.body;
    var nodes = root.querySelectorAll('[data-translate]');
    if (!nodes.length) return;
    var texts = [];
    nodes.forEach(function (n) {
        var src = n.getAttribute('data-translate-src') || n.textContent.trim();
        if (!n.getAttribute('data-translate-src')) n.setAttribute('data-translate-src', src);
        // Try dict first
        var dictRes = autoTranslate(src, lang);
        if (dictRes && dictRes !== src && !/[\u0590-\u05FF]/.test(dictRes)) {
            n.textContent = dictRes;
            return;
        }
        // Try localStorage
        var cached = getRemoteCached(src, lang);
        if (cached) { n.textContent = cached; return; }
        texts.push(src);
    });
    if (!texts.length) return;
    remoteTranslateBatch(texts, lang).then(function (map) {
        nodes.forEach(function (n) {
            var src = n.getAttribute('data-translate-src');
            if (src && map[src]) n.textContent = map[src];
        });
    });
}

/** Translate a single string with dict → cache → API fallback. Returns a Promise. */
function smartTranslate(text, lang, isName) {
    if (!text || lang === 'he') return Promise.resolve(text);
    var dictRes = autoTranslate(text, lang, isName);
    if (dictRes && dictRes !== text && !/[\u0590-\u05FF]/.test(dictRes)) return Promise.resolve(dictRes);
    var cached = getRemoteCached(text, lang);
    if (cached !== null) return Promise.resolve(cached);
    return remoteTranslateBatch([text], lang).then(function (map) {
        return map[text] || dictRes || text;
    });
}

window.applyRemoteTranslations = applyRemoteTranslations;
window.smartTranslate = smartTranslate;
window.remoteTranslateBatch = remoteTranslateBatch;
