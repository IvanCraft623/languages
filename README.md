<div align="center">
  <h1>🌐 languages</h1>
  <p>Multi-language system virion</p>
</div>

## Description:
A pocketmine virion that supports plugins to make a multi-language system

## Usage
Import `Translator` and `Language` classes.
```php
use IvanCraft623\languages\Language;
use IvanCraft623\languages\Translator;
```

### Create a Translator instance
You will need to create and save your translator instance in a variable.
```php
$this->translator = new Translator($plugin);
```
`$plugin` contains an instance of your PluginBase

### Create and register Languages
Requires 2 arguments:
- `locale` => [Language locale](#locales).
- `translations` => An array with all the language translations. Must include a translation of the language name.
```php
$english = new Language("en_US", ["name" => "English", "message.hello.player" => "Hi %name!", "message.hello.world" => "Hello world!"]);
$spanish = new Language("es_MX", ["name" => "Español", "message.hello.player" => "¡Hola %name!", "message.hello.world" => "¡Hola mundo!"]);
$this->translator->registerLanguage($english);
$this->translator->registerLanguage($spanish);
```

### Set default Language
When the message is sent to the console or translation is not available, the default Language is used.
```php
$this->translator->setDefaultLanguage($english);
```

### Tranlate
For example, when a player joins the server. You can also replace parameters.
```php
$player->sendMessage($this->translator->translate($player, "message.hello.player", ["%name" => $player->getName()]));
```
If the translation has no parameters to replace you can just omit it.
```php
$player->sendMessage($this->translator->translate($player, "message.hello.world"));
```

# Locales
| Locale | Language |
| :------------- | --------------------: |
| en_US         | English (United States) |
| en_GB         | English (United Kingdom) |
| de_DE         | Deutsch (Deutschland) |
| es_ES         | Español (España) |
| es_MX         | Español (México) |
| fr_FR         | Français (France) |
| fr_CA         | Français (Canada) |
| it_IT         | Italiano (Italia) |
| ja_JP         | 日本語 (日本)           |
| ko_KR         | 한국어 (대한민국)       |
| pt_BR         | Português (Brasil) |
| pt_PT         | Português (Portugal) |
| ru_RU         | Русский (Россия)     |
| zh_CN         | 中文(简体)             |
| zh_TW         | 中文(繁體)             |
| nl_NL         | Nederlands (Nederland) |
| bg_BG         | Български (България) |
| cs_CZ         | Čeština (Česko)       |
| da_DK         | Dansk (Danmark)       |
| el_GR         | Ελληνικά (Ελλάδα)       |
| fi_FI         | Suomi (Suomi)         |
| hu_HU         | Magyar (Magyarország) |
| id_ID         | Indonesia (Indonesia) |
| nb_NO         | Norsk bokmål (Norge)  |
| pl_PL         | Polski (Polska)      |
| sk_SK         | Slovenčina (Slovensko) |
| sv_SE         | Svenska (Sverige)    |
| tr_TR         | Türkçe (Türkiye)     |
| uk_UA         | Українська (Україна) |
