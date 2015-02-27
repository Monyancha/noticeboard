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


/**
 * Make an xml feed
 * @param $feed
 * @param $items
 * @return string XML String
 */
function makeRSSXML($feed, $items)
{
    /*
         * <?xml version="1.0" encoding="utf-8"?>
            <rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
                <channel>
                    <title>Alerts</title>
                    <link>http://usiu.aksalj.me/assets/xml/alerts.xml</link>
                    <description>Notice board alerts</description>
                    <lastBuildDate>Fri, 06 Feb 2015 06:37:54 GMT</lastBuildDate>

                    <item>
                        <title>PRSK Recognizes USIU-Africa Student as Young Communicator of the Year</title>
                        <link>http://www.usiu.ac.ke/index/on-campus/news/prsk-recognizes-usiu-africa-student-as-young-communicator-of-the-year</link>
                        <media:thumbnail url="http://www.usiu.ac.ke/index/images/News/Sam-Kariuki-2.jpg"/>
                        <description>Samuel Waitathu Kariuki, a senior majoring in Journalism with a concentration in Public Relations at USIU-Africa’s School of Science and Technology, was recognized as the Young Communicator of the Year at the 2014 Public Relations Society of Kenya (PRSK) Awards for Excellence. The gala event was held at the Safari Park Hotel in Nairobi on December 5, 2014.</description>
                        <content:encoded>
                            <![CDATA[
                                <p>
                                    This year, the awards received fifty nine entries and following adjudication by a panel of judges, thirteen winners were drawn from academia, private and public organizations. <br /><br />Samuel’s entry was inspired by a class project that required him to integrate Marketing and Communications tactics for the success of his campaign whose goal was to encourage the youth to apply for loans from the Uwezo Fund. His campaign dubbed YOLO (You Only Live One) encouraged the youth to follow their dreams and in so doing, view entrepreneurship as a viable option. This in turn would create the need for funding for their enterprises, encouraging the youth to approach the Uwezo fund for loans. <br /><br />The approach of the campaign was to use print, electronic and digital platforms to promote the key messages. With the increased popularity of digital platforms amongst the youth, Sam integrated the use of a hashtag in his campaign #iStarted for easier adoption of his message.<br /><br />Kariuki is excited at the possibilities that lie ahead of him. One of his career goals is to help the region understand the key role Public Relations plays in the economy as he believes that the profession is often misunderstood. “Countries and Organizations at large must understand that the right messages communicated at the right time through the right channels can spur an economy in the right direction,” explains Samuel.<br /><br />The faculty at the School of Science and Technology were given special recognition by Samuel for their special support in preparing him for his submission to the 2014 PRSK Awards and for their efforts in helping bridge the gap between the Journalism program course work and the real work environment.<br /><br />This is the fourth time a USIU-Africa student has scooped the award with Amanda Gicharu having been recognized twice consecutively in 2005 and 2006 and Wanjiku Wainaina having been recognized in 2009. <br /><br />The Digital Media Boot Camp that USIU-Africa partnered with Globetrack International in July 2014 was also awarded the New Media PR Campaign of the Year.<br />
                                </p>
                            ]]>
                        </content:encoded>
                        <author>Zakaria Davis</author>
                        <pubDate>Fri, 06 Feb 2015 06:37:54 GMT</pubDate>
                    </item>

                </channel>
            </rss>
         */

    $xml = '<?xml version="1.0" encoding="utf-8"?>'."\n";
    $xml .= '<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">'."\n";
    $xml .= "\t".'<channel>'."\n";
    $xml .= "\t\t".'<title>'.$feed->title.'</title>'."\n";
    $xml .= "\t\t".'<link>'.site_url('/feed/'.$feed->slug).'</link>'."\n";
    $xml .= "\t\t".'<description>'.$feed->description.'</description>'."\n";
    $xml .= "\t\t".'<lastBuildDate>'.date("D, d M Y H:i:s T", strtotime($feed->date)).'</lastBuildDate>'."\n\n";

    foreach($items as $item) {
        $xml .= "\t\t".'<item>'."\n";
        $xml .= "\t\t\t".'<title>'.$item->title.'</title>'."\n";
        $xml .= "\t\t\t".'<link>'.$item->link.'</link>'."\n";
        $xml .= "\t\t\t".'<media:thumbnail url="'.$item->image.'"/>'."\n";
        $xml .= "\t\t\t".'<description>'.$item->title.'</description>'."\n";
        $xml .= "\t\t\t".'<content:encoded><![CDATA['.$item->content.']]></content:encoded>'."\n";
        $xml .= "\t\t\t".'<author>'.$item->author.'</author>'."\n";
        $xml .= "\t\t\t".'<pubDate>'.date("D, d M Y H:i:s T", strtotime($item->date)).'</pubDate>'."\n";
        $xml .= "\t\t".'</item>'."\n";
    }

    $xml .= "\t".'</channel>'."\n";
    $xml .= '</rss>'."\n";

    return $xml;
}