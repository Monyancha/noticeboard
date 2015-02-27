<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : itemmodel.php
 *  Date : 2/23/15 10:31 AM
 *  Description :
 *  
 */

/*
* <item>
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

 */

class ItemModel extends CI_Model {

    const TABLE = "items";

    function __construct() {
        parent::__construct();
    }

    /**
     * @param $feedId
     * @return array
     */
    function getFeedItems($feedId) {
        $query = $this->db->get_where(self::TABLE, array('feed' => $feedId));
        $result = $query->result();
        if(!$result) {
            $result = array();
        }
        return $result;
    }

    /**
     * Add item
     * @param $feed
     * @param $title
     * @param $description
     * @param $content
     * @param $image
     * @param $author
     * @param $link
     * @return mixed
     */
    public function addItem($feed, $title, $description, $content, $image, $author, $link) {
        $data = array(
            'title' => $title ,
            'description' => $description ,
            'image' => $image,
            'content' => $content,
            'author' => $author,
            'feed' => $feed,
            'link' => $link
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

    /**
     * Update item
     * @param $id
     * @param $feed
     * @param $title
     * @param $description
     * @param $content
     * @param $image
     * @param $author
     * @param $link
     * @return mixed
     */
    public function updateItem($id, $feed, $title, $description, $content, $image, $author, $link) {
        $data = array(
            'title' => $title ,
            'description' => $description ,
            'image' => $image,
            'content' => $content,
            'author' => $author,
            'feed' => $feed,
            'link' => $link
        );

        $this->db->where('id', $id);
        return $this->db->update(self::TABLE, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeItem($id) {
        return $this->db->delete(self::TABLE, array('id' => $id));
    }

}