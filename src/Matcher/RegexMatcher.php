<?php

namespace TemplateEngine\Matcher;

class RegexMatcher implements MatcherInterface {
	const OPEN_TAG = '{#';
	const CLOSE_TAG = '#}';

	private function group(string $part, string $name): string {
		return "(?<$name>$part)";
	}

	private function getRegex(): string {
		$openTag = self::OPEN_TAG;
		$closeTag = self::CLOSE_TAG;

		$expression = '/';
		$expression .= '(?<fullMatches>';
		$expression .= $this->group($openTag, 'openTags');
		$expression .= '\s?';
		$expression .= $this->group('[a-zA-Z]+', 'keys');
		$expression .= '\s?';
		$expression .= $this->group($closeTag, 'closeTags');
		$expression .= ")";
		$expression .= '/';

		return $expression;
	}

	public function match(string $str): array {
		$matches = [];
		preg_match_all($this->getRegex(), $str, $matches);
		return $matches;
	}
}