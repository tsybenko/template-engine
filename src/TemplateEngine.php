<?php

namespace TemplateEngine;

use TemplateEngine\Matcher\Factory as MatcherFactory;

class TemplateEngine {

	private $matcher;
	private $vars = [];

	public function __construct(array $options = [])
	{
		$factory = new MatcherFactory();

		$this->matcher = (isset($options['matcher']) && !empty($options['matcher']))
			? $factory->make($options['matcher'])
			: $factory->make('null');

	}

	public function defineVar(string $key, $value): bool {
		if (!$this->hasVar($key)) {
			$this->vars[$key] = $value;
			return true;
		}

		return false;
	}

	public function hasVar($key): bool {
		return (isset($this->vars[$key]) && !empty($this->vars[$key]));
	}

	public function getVar($key) {
		$value = '';

		if ($this->hasVar($key)) {
			$value = $this->vars[$key];
		}

		return $value;
	}

	public function render(string $str) {
		$matches = $this->matcher->match($str);
		$keys = $matches['keys'];

		foreach ($matches['fullMatches'] as $i => $var) {
			if ($this->hasVar($keys[$i])) {
				$str = str_replace($var, $this->getVar($keys[$i]), $str);
			}
		}

		return $str;
	}
}