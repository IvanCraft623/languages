<?php

declare(strict_types=1);

namespace IvanCraft623\languages;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use InvalidArgumentException;

final class Translator {

	public static array $translators = [];

	public const MINECRAFT_LOCALES = [ # https://minecraft.fandom.com/wiki/Language
		"bg_BG", # Bulgarian
		"cs_CZ", # Czech
		"da_DK", # Danish
		"de_DE", # German
		"el_GR", # Greek
		"en_GB", # British English
		"en_US", # American English
		"es_ES", # Spanish
		"es_MX", # Mexican Spanish
		"fi_FI", # Finnish
		"fr_CA", # Canadian French
		"fr_FR", # French
		"hu_HU", # Hungarian
		"id_ID", # Indonesian
		"it_IT", # Italian
		"ja_JP", # Japanese
		"ko_KR", # Korean
		"nl_NL", # Dutch
		"nb_NO", # Norwegian Bokmål
		"pl_PL", # Polish
		"pt_BR", # Brazilian Portuguese
		"pt_PT", # Portuguese
		"ru_RU", # Russian
		"sk_SK", # Slovak
		"sv_SE", # Swedish
		"tr_TR", # Turkish
		"uk_UA", # Ukrainian
		"zh_CN", # Chinese Simplified
		"zh_TW"  # Chinese Traditional
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
		$keys = array_merge(["%prefix"], array_keys($replacements));
		$values = array_merge([$this->plugin->getPrefix()], array_values($replacements));

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
		return str_replace($keys, $values, $translation);
	}
}
