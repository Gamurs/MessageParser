<?php

namespace Gamurs\MessageParser;

use Illuminate\Database\DatabaseManager;
use Illuminate\Config\Repository;

/**
 * Class Parser
 * @package Gamurs\MessageParser
 * @author Euan T. <euantorano@gmail.com>
 * @version 1.0
 * @license http://opensource.org/licenses/mit-license.php MIT license
 */
class Parser
{
	/**
	 * Illuminate config repository.
	 *
	 * @var Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Illuminate query builder.
	 *
	 * @var Illuminate\Database\DatabaseManager
	 */
	protected $db;

	/**
	 * A list of bad words to be filtered.
	 * @var array Array of bad words.
	 */
	protected $badWords;

	/**
	 * A list of the replacement words to be user.
	 * @var array Array of replacement words matching up to their $badWords counterparts.
	 */
	protected $replacementWords;

	/**
	 * Create a new parser instance.
	 *
	 * @param Repository $config
	 */
	public function __construct(Repository $config, DatabaseManager $db)
	{
		$this->config = $config;
		$this->db = $db;
	}

	/**
	 * Get the list of bad words.
	 */
	protected function getBadWords()
	{
		if ($this->config->get('message-parser::config.badwords.use_db')) {
			$query = $this->db->table($this->config->get('message-parser::badwords.table'))->lists('replacement', 'word');
			$badWords = array();
			$replacements = array();

			foreach ($query as $key => $val) {
				$badWords[] = "/".preg_quote($key)."/i";
				$replacements[] = $val;
			}

			$this->badWords = $badWords;
			$this->replacementWords = $replacements;
		} else {
			$query = $this->config->get('message-parser::badwords.words');

			$badWords = array();
			$replacements = array();

			foreach ($query as $key => $val) {
				$badWords[] = "/".preg_quote($key)."/i";
				$replacements[] = $val;
			}

			$this->badWords = $badWords;
			$this->replacementWords = $replacements;
		}
	}

	/**
	 * Filter defined bad words from a string.
	 *
	 * @param string $message The string to parse.
	 *
	 * @return mixed|string The parsed string.
	 */
	public function filterBadWords($message = '')
	{
		if (!is_array($this->badWords)) {
			$this->getbadWords();
		}

		$message = (string) $message;

		if (empty($message)) {
			return '';
		}

		return preg_replace($this->badWords, $this->replacementWords, $message);
	}
}