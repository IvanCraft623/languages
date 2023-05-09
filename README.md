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
| de_DE         | Deutsch (Germany) |
| es_ES         | Español (Spanish) |
| es_MX         | Español (Mexican Spanish) |
| fr_FR         | Français (French) |
| fr_CA         | Français (Canadian French) |
| it_IT         | Italiano (Italian) |
| ja_JP         | 日本語 (Japanese)           |
| ko_KR         | 한국어 (Korean)       |
| pt_BR         | Português (Brazilian Portuguese) |
| pt_PT         | Português (Portuguese) |
| ru_RU         | Русский (Russian)     |
| zh_CN         | 中文(Chinese Simplified)             |
| zh_TW         | 中文(Chinese Traditional)             |
| nl_NL         | Nederlands (Netherlands) |
| bg_BG         | Български (Bulgarian) |
| cs_CZ         | Čeština (Czech)       |
| da_DK         | Dansk (Danish)       |
| el_GR         | Ελληνικά (Greek)       |
| fi_FI         | Suomi (Finnish)         |
| hu_HU         | Magyar (Hungarian) |
| id_ID         | Indonesia (Indonesian) |
| nb_NO         | Norsk bokmål (Norwegian Bokmål)  |
| pl_PL         | Polski (Polish)      |
| sk_SK         | Slovenčina (Slovak) |
| sv_SE         | Svenska (Swedish)    |
| tr_TR         | Türkçe (Turkish)     |
| uk_UA         | Українська (Ukrainian) |
