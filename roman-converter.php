<?php
/**
* Convert roman numerals to arabic numerals, ie. an integer
*/
class RomanConverter
{
	public $digitMap = [
		['roman' => 'I', 'integer' => 1],
		['roman' => 'II', 'integer' => 2],
		['roman' => 'III', 'integer' => 3],
		['roman' => 'IV', 'integer' => 4],
		['roman' => 'V', 'integer' => 5],
		['roman' => 'VI', 'integer' => 6],
		['roman' => 'VII', 'integer' => 7],
		['roman' => 'VIII', 'integer' => 8],
		['roman' => 'IX', 'integer' => 9],
		['roman' => 'X', 'integer' => 10],
		['roman' => 'XI', 'integer' => 11],
		['roman' => 'XII', 'integer' => 12],
		['roman' => 'XIII', 'integer' => 13],
		['roman' => 'XIV', 'integer' => 14],
		['roman' => 'XV', 'integer' => 15],
		['roman' => 'XVI', 'integer' => 16],
		['roman' => 'XVII', 'integer' => 17],
		['roman' => 'XVIII', 'integer' => 18],
		['roman' => 'XIX', 'integer' => 19],
		['roman' => 'XX', 'integer' => 20],
		['roman' => 'XXX', 'integer' => 30],
		['roman' => 'XL', 'integer' => 40],
		['roman' => 'L', 'integer' => 50],
		['roman' => 'LX', 'integer' => 60],
		['roman' => 'LXX', 'integer' => 70],
		['roman' => 'LXXX', 'integer' => 80],
		['roman' => 'XC', 'integer' => 90],
		['roman' => 'C', 'integer' => 100],
		['roman' => 'CC', 'integer' => 200],
		['roman' => 'CCC', 'integer' => 300],
		['roman' => 'CD', 'integer' => 400],
		['roman' => 'D', 'integer' => 500],
		['roman' => 'DC', 'integer' => 600],
		['roman' => 'DCC', 'integer' => 700],
		['roman' => 'DCCC', 'integer' => 800],
		['roman' => 'CM', 'integer' => 900],
		['roman' => 'M', 'integer' => 1000]
	];

	private function getNextMatch($numeral)
	{
		$lastMatch = false;
		$match = true;
		$i = 1;

		while ($match !== false) {
			$match = array_reduce($this->digitMap, function($carry, $digit) use ($i, $numeral) {
				return strrpos(substr($numeral, 0, $i), $digit['roman']) === 0 ? $digit : $carry;
			}, false);

			$match = $match !== $lastMatch ? $match : false;
			$lastMatch = $match !== false ? $match : $lastMatch;
			$i += 1;
		}

		return $lastMatch;
	}

	/**
	 * Convert a string of roman numerals to a plain integer
	 * @param  String $romanNumerals
	 * @return Integer
	 */
	public function toInteger($romanNumerals)
	{
		$romanNumerals = strtoupper($romanNumerals);
		$count = 0;
		$i = 0;

		while ($i < strlen($romanNumerals)) {
			$match = $this->getNextMatch(substr($romanNumerals, $i));

			if (!is_array($match)) {
				throw new Exception('String contained characters that aren\'t roman numerals', 1);
			}

			$i += strlen($match['roman']);
			$count += $match['integer'];
		}

		return $count;
	}
}
