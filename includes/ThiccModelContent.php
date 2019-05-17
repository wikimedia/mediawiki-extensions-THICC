<?php

/**
 * @class ThiccModelContent
 */
class ThiccModelContent extends JsonContent {

	/**
	 * @param string $text
	 */
	public function __construct( $text ) {
		parent::__construct( $text, 'ThiccModelContent' );
	}
}
