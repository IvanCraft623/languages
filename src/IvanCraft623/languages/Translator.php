<?php

declare(strict_types=1);

namespace IvanCraft623\languages;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use InvalidArgumentException;

final class Translator {

	public static array $translators = [];

	public const MINECRAFT_LOCALES = [
		# https://minecraft.fandom.com/wiki/Language
	    "af_ZA", // Afrikaans
	    "ar_SA", // Arabic
	    "ast_ES", // Asturian
		"az_AZ", // Azerbaijani
		"bg_BG", // Bulgarian
		"bn_BD", // Bengali
		"bs_BA", // Bosnian
		"ca_ES", // Catalan
		"cs_CZ", // Czech
		"cy_GB", // Welsh
		"da_DK", // Danish
		"de_DE", // German
		"el_GR", // Greek
		"en_AU", // English, Australian
		"en_CA", // English, Canadian
		"en_GB", // English, British
		"en_NZ", // English, New Zealand
		"en_PT", // English, Pirate
		"en_UD", // English, upside down
		"en_US", // English, US
		"eo_UY", // Esperanto
		"es_AR", // Spanish, Argentine
		"es_CL", // Spanish, Chilean
		"es_ES", // Spanish, Spain
		"es_MX", // Spanish, Mexican
		"et_EE", // Estonian
		"eu_ES", // Basque
		"fa_IR", // Farsi
		"fi_FI", // Finnish
		"fil_PH", // Filipino
		"fo_FO", // Faroese
		"fr_CA", // French, Canadian
		"fr_FR", // French, France
		"fy_NL", // Frisian
		"ga_IE", // Irish
		"gd_GB", // Scottish Gaelic
		"gl_ES", // Galician
		"gu_IN", // Gujarati
		"he_IL", // Hebrew
		"hi_IN", // Hindi
		"hr_HR", // Croatian
		"hu_HU", // Hungarian
		"hy_AM", // Armenian
		"id_ID", // Indonesian
		"ig_NG", // Igbo
		"io_EN", // Ido
		"is_IS", // Icelandic
		"it_IT", // Italian
		"ja_JP", // Japanese
		"jv_ID", // Javanese
		"ka_GE", // Georgian
		"kk_KZ", // Kazakh
		"km_KH", // Khmer
		"kn_IN", // Kannada
		"ko_KR", // Korean
		"ku_TR", // Kurdish
		"la_LA", // Latin
		"lb_LU", // Luxembourgish
		"lo_LA", // Lao
		"lt_LT", // Lithuanian
		"lv_LV", // Latvian
		"mg_MG", // Malagasy
		"mi_NZ", // Maori
		"mk_MK", // Macedonian
		"ml_IN", // Malayalam
		"mn_MN", // Mongolian
		"mr_IN", // Marathi
		"ms_MY", // Malay
		"mt_MT", // Maltese
		"nb_NO", // Norwegian Bokmål
		"ne_NP", // Nepali
		"nl_NL", // Dutch
		"nn_NO", // Norwegian Nynorsk
		"no_NO", // Norwegian
		"nso_ZA", // Northern Sotho
		"oc_FR", // Occitan
		"or_IN", // Oriya
		"pa_IN", // Punjabi
		"pl_PL", // Polish
		"pt_BR", // Portuguese, Brazil
		"pt_PT", // Portuguese, Portugal
		"qu_PE", // Quechua
		"ro_RO", // Romanian
		"ru_RU", // Russian
		"sc_IT", // Sardinian
		"se_NO", // Northern Sami
		"sk_SK", // Slovak
		"sl_SI", // Slovenian
		"sq_AL", // Albanian
		"sr_RS", // Serbian
		"sv_SE", // Swedish
		"sw_KE", // Swahili
		"ta_IN", // Tamil
		"te_IN", // Telugu
		"th_TH", // Thai
		"tl_PH", // Tagalog
		"tr_TR", // Turkish
		"tt_RU", // Tatar
		"udm_RU", // Udmurt
		"uk_UA", // Ukrainian
		"ur_PK", // Urdu
		"uz_UZ", // Uzbek
		"vi_VN", // Vietnamese
		"xh_ZA", // Xhosa
		"yi_DE", // Yiddish
		"yo_NG", // Yoruba
		"zh_CN", // Chinese, Simplified
		"zh_HK", // Chinese, Hong Kong
		"zh_TW", // Chinese, Traditional
		"zu_ZA", // Zulu
	];

	private PluginBase $plugin;

	/** @var Language[] */
	private array $languages = [];

	private Language $defaultLanguage;
	
	public function __construct(PluginBase $plugin) {
		$this->plugin = $plugin;
	}

	public function getPlugin(): PluginBase{
		return $this->plugin;
	}

	public function getDefaultLanguage(): Language {
		return $this->defaultLanguage;
	}

	public function setDefaultLanguage(Language $language): void {
		if (!in_array($language, $this->languages, true)) {
			throw new InvalidArgumentException("Language is not registered");
		}
		$this->defaultLanguage = $language;
	}

	public function isLanguageRegistered(string $locale): bool {
		return isset($this->languages[$locale]);
	}

	public function registerLanguage(Language $language, bool $override = false): void {
		$locale = $language->getLocale();
		if (!in_array($language->getLocale(), self::MINECRAFT_LOCALES, true)) {
			throw new InvalidArgumentException("Language ".$locale." is not available in minecraft");
		}
		if (!$override && $this->isLanguageRegistered($locale)) {
			throw new InvalidArgumentException("Trying to overwrite an already registered Language");
		}
		$this->languages[$locale] = $language;
	}

	public function getLanguages(): array {
		return $this->languages;
	}

	public function getLanguage(string $locale): ?Language {
		return $this->languages[$locale] ?? null;
	}

	public function translate(?CommandSender $target, string $key, array $replacements = []): string {
		$language = (($target instanceof Player) ? ($this->languages[$target->getLocale()] ?? null) : null) ?? $this->defaultLanguage;
		$translation = $language->getTranslation($key);

		if ($translation === null) {
			$defaultTranslation = $this->defaultLanguage->getTranslation($key);
			if ($defaultTranslation === null) {
				$this->plugin->getLogger()->error("Unknown translation key ".$key);
				return "";
			} else {
				$translation = $defaultTranslation;
			}
		}
		return str_replace(array_keys($replacements), array_values($replacements), $translation);
	}
}
