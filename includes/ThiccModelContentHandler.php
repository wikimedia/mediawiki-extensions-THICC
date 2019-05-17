<?php

/**
 * Content handler for ThiccModelContent.
 *
 * We extend TextContentHandler instead of JsonContentHandler since
 * we do not display this as JSON code except upon request.
 *
 * @file
 */

class ThiccModelContentHandler extends TextContentHandler {

	public function __construct(
		$modelId = 'ThiccModelContent',
		$formats = [ CONTENT_FORMAT_JSON, CONTENT_FORMAT_TEXT ]
	) {
		parent::__construct( $modelId, $formats );
	}
}
