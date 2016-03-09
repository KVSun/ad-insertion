<?php
namespace Functions;

/**
 * Appends <option>s to a <datalist>. Useful in `array_reduce`
 *
 * @param DOMElement $list The <datalist> to append to
 * @param string     $item The value of the option to append
 * @return DOMElement      The <datalist> with the option appended
 *
 * @example $list = array_reduce([], \Functions\add_datalist_item, new \DOMElement('datalist'));
 */
function add_datalist_item(\DOMElement $list, $item)
{
	$child = $list->appendChild($list->ownerDocument->createElement('option'));
	$child->setAttribute('value', $item);
	return $list;
}
