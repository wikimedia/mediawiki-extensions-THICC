<?php

/**
 * Threads for our thicckener
 */
class ThiccModelContent extends JsonContent {

	/** @var bool Whether contents have been populated */
	protected $decoded = false;

	/** @var string */
	protected $displayName;

	/** @var array */
	protected $metadata;

	/** @var array */
	protected $comment;

	/** @var string How to display contents */
	protected $displaymode;

	/** @var string Error message text */
	protected $errortext;

	/**
	 * @param string $text
	 */
	public function __construct( $text ) {
		parent::__construct( $text, 'ThiccModelContent' );
	}

	/**
	 * Decode and validate the contents
	 * @return bool Whether the contents are valid
	 */
	public function isValid() {
		$jsonParse = $this->getData();
		if ( $jsonParse->isGood() ) {
			// TODO: Check schema, etc
			return true;
		}
		return false;
	}

	/**
	 * Decode the JSON contents and populate protected variables
	 */
	protected function decode() {
		if ( $this->decoded ) {
			return;
		}

		$jsonParse = $this->getData();
		$data = $jsonParse->isGood() ? $jsonParse->getValue() : null;
		if ( $data ) {
			if ( !$this->isValid() ) {
				$this->displaymode = 'error';
				if ( !parent::isValid() ) {
					// It's not even valid json
					$this->errortext = htmlspecialchars(
						$this->getText()
					);
				} else {
					$this->errortext = FormatJson::encode(
						$data,
						true,
						FormatJson::ALL_OK
					);
				}
			} else {
				$this->displayName = $data->display_name ?? '';
				$this->metadata = $data->metadata ?? [];
				$this->comment = $data->comment ?? [];

				// TODO: sort out metadata
				// TODO: sort out comment data
			}
		}

		$this->decoded = true;
	}

	/**
	 * Fill $output with information derived from the content.
	 *
	 * @param Title $title
	 * @param int $revId
	 * @param ParserOptions $options
	 * @param bool $generateHtml
	 * @param ParserOutput &$output
	 */
	protected function fillParserOutput( Title $title, $revId,
		ParserOptions $options, $generateHtml, ParserOutput &$output
	) {
		$this->decode();
		$html = '';

		// If error, then bypass all this and just show the offending JSON
		if ( $this->displaymode == 'error' ) {
			$html = '<div class=errorbox>'
			. wfMessage( 'invalid' )
			. "</div>\n<pre>"
			. $this->errortext
			. '</pre>';
		} else {
			$html .= Html::openElement(
				'div',
				[ 'class' => 'thicc-thread' ]
			);
			$html .= Html::element( 'h2', [], $this->displayName );

			// do first comment
			$html .= $this->renderComment( $this->comment );

			$html .= Html::closeElement( 'div' );
		}

		$output->setText( $html );
	}

	/* ??? */
	private function renderComment( $comment ) {
		/* object(stdClass)#412 (3) {
			["content"]=> string(19) "Blah blah blah blah"
			["metadata"]=> object(stdClass)#411 (2) {
				["author"]=> string(8) "Your mom"
				["timestamp"]=> string(5) "~~~~~"
			}
			["children"]=> array(0) { }
		} */
		$content = $comment->content; // parse this
		$author = $comment->metadata->author; // get user with name
		$timestamp = $comment->metadata->timestamp; // convert/render

		$html = '';

		$html .= Html::openElement( 'div', [] );
		$html .= Html::openElement( 'div', [] );
		$html .= Html::rawElement( 'div', [], $content );
		$html .= Html::rawElement( 'div', [], $author . $timestamp );

		$html .= Html::closeElement( 'div' );

		if ( is_array( $comment->children ) ) {
			foreach ( $comment->children as $childComment ) {
				$html .= $this->renderComment( $childComment );
			}
		}

		$html .= Html::closeElement( 'div' );

		return $html;


		// parse current comment
		// do wrappers and stuff
		// foreach children, nest $this->renderComment( $child )
	}
}
