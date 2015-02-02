<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : syndication_helper.php
 *  Date : 2/2/15 5:53 PM
 *  Description :
 *
 */


use PicoFeed\Reader\Reader;

/**
 * Read an RSS feed
 * @param $url
 * @return null|\PicoFeed\Parser\Feed
 */
function readRSS($url)
{

    try {

        $reader = new Reader;
        $resource = $reader->download($url);

        $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );

        $feed = $parser->execute();

        return $feed;

    } catch (Exception $e) {
        // TODO: Log error
    }
    return null;
}


/**
 * Read an atom feed
 * @param $url
 */
function readAtom($url)
{
    throw new RuntimeException("Atom Not Implemented");
}