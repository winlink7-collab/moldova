/**
 * Auto-translate dynamic content from Hebrew to Russian/English
 * Uses a dictionary for common terms + basic transliteration
 */

var DICT = {
    ru: {
        // Names
        'אלנה': 'Елена', 'לנה': 'Елена', 'נטליה': 'Наталия', 'אולגה': 'Ольга',
        'יקטרינה': 'Екатерина', 'ויקטוריה': 'Виктория', 'אנה': 'Анна',
        'אינסטסיה': 'Анастасия', 'מריה': 'Мария', 'אירינה': 'Ирина',
        'טטיאנה': 'Татьяна', 'סבטלנה': 'Светлана', 'יוליה': 'Юлия',
        'אלינה': 'Алина', 'דיאנה': 'Диана', 'קסניה': 'Ксения',
        'ולריה': 'Валерия', 'דריה': 'Дарья', 'סופיה': 'София',
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
        // Names
        'אלנה': 'Elena', 'לנה': 'Elena', 'נטליה': 'Natalia', 'אולגה': 'Olga',
        'יקטרינה': 'Yekaterina', 'ויקטוריה': 'Victoria', 'אנה': 'Anna',
        'אינסטסיה': 'Anastasia', 'מריה': 'Maria', 'אירינה': 'Irina',
        'טטיאנה': 'Tatiana', 'סבטלנה': 'Svetlana', 'יוליה': 'Julia',
        'אלינה': 'Alina', 'דיאנה': 'Diana', 'קסניה': 'Ksenia',
        'ולריה': 'Valeria', 'דריה': 'Daria', 'סופיה': 'Sofia',
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
 * Translate a Hebrew text string to target language
 */
function autoTranslate(text, lang) {
    if (!text || !lang || lang === 'he') return text;
    var dict = DICT[lang] || {};

    // Try exact match first
    if (dict[text]) return dict[text];

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
    return result;
}

/**
 * Translate profile object fields
 */
function translateProfile(p, lang) {
    if (!lang || lang === 'he') return p;
    var copy = Object.assign({}, p);
    if (copy.name) copy.name = autoTranslate(copy.name, lang);
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
