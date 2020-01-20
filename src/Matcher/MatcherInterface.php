<?php

namespace TemplateEngine\Matcher;

interface MatcherInterface
{
	public function match(string $str): array;
}