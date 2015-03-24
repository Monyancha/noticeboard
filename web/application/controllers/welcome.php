<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct() {
		parent::__construct();
    }

	/**
	 * Landing page
	 */
	public function index() {
        $team = array( // TODO: Read from DB
            "cyrus" => array(
                "name" => "Cyrus S. Koroma",
                "country" => "Liberia",
                "position" => "Lead Designer",
                "major" => "BSc. Applied Computer Technology",
                "speciality" => "Software Engineering",
                "profile" => "/assets/img/team/koroma.jpg",
                "quote" => "Computer programming is not only about going to the computer and writing lots of codes, but it also involves collaboration and team work. Working as a group enhances your learning  skills, ability to wildly think and also contribute in group discussions.",
                "saying" => "Attempt the end, and never stand no doubt; Nothing is so hard, but search will find it out.",
                "social" => array(
                    "envelope" => "mailto:ckoroma91@gmail.com",
                    "bitbucket" => "https://bitbucket.org/Koroma",
                )
            ),

            "aksalj" => array(
                "name" => "Salama A. Balekage",
                "country" => "DR Congo",
                "position" => "Lead Developer",
                "major" => "BSc. Applied Computer Technology",
                "speciality" => "Distributed Systems & Mobile Computing",
                "profile" => "/assets/img/team/balekage.jpg",
                "quote" => "There is nothing more gratifying in this world than the feeling of being in control; the feeling of controlling the world, having it all at your fingertips. Everyone, at some point in their lives, has fantasized about being the master of the universe. Well, I get to be just that, every time I write code. I get to impose my will on all my minions; even if they are just 1s and 0s...",
                "saying" => "I Am Groot.",
                "social" => array(
                    "envelope" => "mailto:aksalj@gmail.com",
                    "twitter" => "https://www.twiter.com/aksalj",
                    "google-plus" => "https://www.google.com/+SalamaAB",
                    "github" => "https://github.com/aksalj",
                )
            ),

            "kaziz" => array(
                "name" => "Joshua K. Muhindo",
                "country" => "Uganda",
                "position" => "Lead Marketer",
                "major" => "BSc. Applied Computer Technology",
                "speciality" => "Forensic Information Technology & Cybercrime",
                "profile" => "/assets/img/team/kazimoto.jpg",
                "quote" => "With the speedy growth of the Internet providing global connectivity to networks around the world, cybercrime and malicious software distributions are on the rise. My duty is to help provide protection of assets and information by securing networks and computer systems. Am also learning how to present evidence in civil and criminal prosecution cases.",
                "saying" => "It takes something more than intelligence to act intelligently.",
                "social" => array(
                    "envelope" => "mailto:joshkaziz@gmail.com",
                    "bitbucket" => "https://bitbucket.org/Joshkaziz",
                )
            ),

            "mwamba" => array(
                "name" => "Joshua M. Kiriungi",
                "country" => "Liberia",
                "position" => "Lead Tester",
                "major" => "BSc. Applied Computer Technology",
                "speciality" => "Distributed Systems & Mobile Computing",
                "profile" => "/assets/img/team/mwamba.jpg",
                "quote" => "I like finding out possible ways of solving difficult problems that relate to everyday endeavor. Even though much of my personal time and assets are consume, but I always consider it as an investment. My focus is on making the impossible, possible. It is advisable to never underestimate yourself because we all have the potential to do amazing things. So, I want to be that guy to make things work and to be look upon as role model for others.",
                "saying" => "If you have a dream, don’t just sit there. Gather courage to believe that you can succeed and leave no stone unturned to make it a reality.",
                "social" => array(
                    "envelope" => "mailto:j.mwashville@gmail.com",
                    "bitbucket" => "https://bitbucket.org/jayvanrey",
                )
            )


        );
		$this->load->view('welcome', array("team" => $team));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */