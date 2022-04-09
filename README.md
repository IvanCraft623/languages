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
Locale | Language
--- | ---
`bg_BG` | Bulgarian
`cs_CZ` | Czech
`da_DK` | Danish
`de_DE` | German
`el_GR` | Greek
`en_GB` | British English
`en_US` | American English
`es_ES` | Spanish
`es_MX` | Mexican Spanish
`fi_FI` | Finnish
`fr_CA` | Canadian French
`fr_FR` | French
`hu_HU` | Hungarian
`id_ID` | Indonesian
`it_IT` | Italian
`ja_JP` | Japanese
`ko_KR` | Korean
`nl_NL` | Dutch
`nb_NO` | Norwegian Bokmål
`pl_PL` | Polish
`pt_BR` | Brazilian Portuguese
`pt_PT` | Portuguese
`ru_RU` | Russian
`sk_SK` | Slovak
`sv_SE` | Swedish
`tr_TR` | Turkish
`uk_UA` | Ukrainian
`zh_CN` | Chinese Simplified
`zh_TW` |  Chinese Traditional
