<?php
/*******************************************************************************
 * Copyright notice
 *
 * Copyright 2013 Sven-S. Porst, Göttingen State and University Library
 *                <porst@sub.uni-goettingen.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 ******************************************************************************/


/**
 * Does Search and Replace with a regular expression.
 */
class Tx_Find_ViewHelpers_RegexpViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {


	/**
	 * Registers own arguments.
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('string', 'string', 'The string to work on; if not given, the content of the tag is used', FALSE, NULL);
		$this->registerArgument('match', 'string', 'The regular expression used for matching', TRUE);
		$this->registerArgument('replace', 'string', 'The regular expression replacement string', FALSE, NULL);
		$this->registerArgument('useMBEreg', 'boolean', 'Whether to use mb_ereg_replace() instead of preg_replace()', FALSE, FALSE);
	}



	/**
	 * @return string
	 */
	public function render() {
		$input = $this->arguments['string'];
		if ($input === NULL) {
			$input = $this->renderChildren();
		}

		$result = NULL;
		if ($this->arguments['replace'] === NULL) {
			$result = preg_match($this->arguments['match'], $input);
		}
		else {
			if (!$this->arguments['useMBEreg']) {
				$result = preg_replace($this->arguments['match'], $this->arguments['replace'], $input);
			}
			else {
				$result = mb_ereg_replace($this->arguments['match'], $this->arguments['replace'], $input);
			}
		}

		return $result;
	}

}

?>