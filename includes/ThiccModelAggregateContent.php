<?php

/**
 * Stores which threads go on the page and thicckens them into a usable display
 */
class ThiccModelAggregateContent extends JsonContent {

	/**
	 * @param string $text
	 */
	public function __construct( $text ) {
		parent::__construct( $text, 'ThiccModelAggregateContent' );
	}

}
