<?php

/**
 * Content handler for ThiccModelAggregateContent.
 *
 * ...this'll do something later.
 *
 * @file
 */

class ThiccModelAggregateContentHandler extends JsonContentHandler {

	public function __construct(
		$modelId = 'ThiccModelAggregateContent',
		$formats = [ CONTENT_FORMAT_JSON ]
	) {
		parent::__construct( $modelId, $formats );

	}

}
