<?php

namespace TemplateEngine\Matcher;

class NullMatcher implements MatcherInterface {
	public function match(string $str): array
	{
		return [
			'fullMatches' => [],
			'openTags' => [],
			'keys' => [],
			'closeTags' => [],
		];
	}
}