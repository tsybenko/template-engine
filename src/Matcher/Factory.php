<?php

namespace TemplateEngine\Matcher;

class Factory {

	public function make($name): MatcherInterface {
		switch ($name) {
			case 'regex':
				return $this->makeRegexMatcher();
			default:
				return $this->makeNullMatcher();
		}
	}

	private function makeRegexMatcher(): MatcherInterface {
		return new RegexMatcher();
	}

	private function makeNullMatcher(): MatcherInterface {
		return new NullMatcher();
	}
}