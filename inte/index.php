<?php

$mailto = 'elisabeth@stereosuper.fr';

$status = '';
/*$errorFirstname = '';
$errorLastname = '';
$errorEmail = '';
$errorMsg = '';*/
$errorSend = '';

mail($mailto, 'hello', 'hey');

if(isset($_POST['submitpitch'])){

    $firstname = isset($_POST['firstname1']) ? strip_tags(stripslashes($_POST['firstname1'])) : '';
    $lastname = isset($_POST['lastname1']) ? strip_tags(stripslashes($_POST['lastname1'])) : '';
    $email = isset($_POST['email1']) ? strip_tags(stripslashes($_POST['email1'])) : '';
    $file = isset($_POST['pitchfile']) ? strip_tags(stripslashes($_POST['pitchfile'])) : '';
    $url = isset($_POST['pitchurl']) ? strip_tags(stripslashes($_POST['pitchurl'])) : '';
    $msg = isset($_POST['pitchtext']) ? strip_tags(stripslashes($_POST['pitchtext'])) : '';

    if(empty($firstname) || empty($lastname) || empty($msg) || empty($email)){
        $status = 'error';
    }

    if(!preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i', $email)){
        $status = 'error';
    }

    if(!$status){

        $name = sprintf('%s %s', $firstname, $lastname);
        $subject = 'New pitch received from alvencapital.com';
        $headers = 'From: "' . $name . '" <' . $email . '>' . "\r\n" .
                   'Reply-To: ' . $email . "\r\n";

        $content = 'From: ' . $name . "\r\n" .
                   'Email: ' . $email . "\r\n" .
                   'Pitch: ' . $url . "\r\n\r\n\r\n" .
                   'Message: ' . "\r\n" . $msg;

        //$sent = mail($mailto, $subject, $content, $headers);
        $sent = mail($mailto, 'hello', 'hey');

        if($sent){
            $status = 'succes';
        }else{
            $status = 'error';
            $errorSend = 'Sorry, an error occured and you pitch couldn\'t be send. Please try again later!';
        }
    }

    echo $status . $errorSend;
}

?>

<!DOCTYPE html>
<html lang='fr-FR' class='no-js'>

    <head>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta charset='utf-8'>
        <title>AlvenCapital</title>
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width,initial-scale=1'>

        <link rel='stylesheet' href='css/main.css'>
        <script src='js/modernizr.min.js'></script>
    </head>

    <body class='home'>

        <header id='header'>
            <div class='container'>
                <a id='logo' href='#'>AlvenCapital</a>
                <nav role='navigation' id='menu-main'>
                    <ul>
                        <li>
                            <a href='#'>Magazine</a>
                        </li><li>
                            <a href='#'>Portfolio</a>
                        </li><li>
                            <a href='#'>Who we are</a>
                        </li>
                    </ul>
                </nav>
                <a id='searchBtn' class='btn-search' href='#'>Explore Alven</a>
                <button id='burger'>
                    <span>Menu</span>
                </button>
                <nav role='navigation' id='menu-responsive'>
                    <div>
                        <div class='col-3 menu-small'>
                            <span class='menu-title'>Think, read, exchange</span>
                            <span class='menu-subtitle'>alven online magazine</span>
                            <ul>
                                <li><a href='#'>About us</a></li>
                                <li><a href='#'>Our investment thesis</a></li>
                                <li><a href='#'>The process to pitch us</a></li>
                            </ul>
                        </div><div class='col-3 menu-small'>
                            <span class='menu-title'>Who we are</span>
                            <span class='menu-subtitle'>a stichy &amp; professionnal team</span>
                            <ul>
                                <li><a href='#'>Who we are</a></li>
                                <li><a href='#'>About us</a></li>
                                <li><a href='#'>Our investment thesis</a></li>
                                <li><a href='#'>The process to pitch us</a></li>
                            </ul>
                        </div><div class='col-2 menu-small'>
                            <span class='menu-title'>Portfolio</span>
                            <span class='menu-subtitle'>what we fund, what we funded</span>
                            <ul>
                                <li>
                                    <a href='#'>Portfolio</a>
                                    <ul>
                                        <li><a href='#'>Actual investments</a></li>
                                        <li><a href='#'>Past investments</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div><div class='col-2 menu-small'>
                            <span class='menu-title'>Contact us</span>
                            <span class='menu-subtitle'>get in touch with us</span>
                            <ul>
                                <li><a href='#'>Send us your pitch</a></li>
                                <li><a href='#'>General questions</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div id='readIndicator' class='read-indicator'></div>
        </header>

        <div class='content-header has-img has-video' id='contentHeader'>
            <div class='container'>
                <h1>
                    Venture capital<br> for talented internet, media&nbsp;&amp;<br> IT entrepreneur
                </h1><ul class='menu-home'>
                    <li>
                        <span>Read us :</span>
                        <a href='#' class='btn-arrow'>Magazine</a>
                    </li><li>
                        <span>We fund :</span>
                        <a href='#' class='btn-arrow'>Portfolio</a>
                    </li><li>
                        <span>Team :</span>
                        <a href='#' class='btn-arrow'>Who we are</a>
                    </li>
                </ul>
            </div>
            <div class='img' style='background-image:url(video/img1.jpg);'>
                <img src='video/img1.jpg' alt=''>
            </div>
            <div class='wrapper-video'>
                <video class='video' poster='video/img1.jpg' autoplay muted loop>
                  <source src='video/alven-movie.mp4' type='video/mp4' />

                </video>
            </div>
        </div>

        <main role='main' id='main'>

            <div class='content-main' id='mainContent'>

                <section class='theme-magazine'>
                    <h2 class='section-title'>Think, read, exchange</h2>
                    <strong class='subtitle'>Alven online magazine</strong>
                    <div class='container'>
                        <div class='section-header'>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sodales mauris. Mauris et aliqae lacus aliquet mattis. Sed mi arcu, tristique id ex ut, facilisis accumsan sapien.
                            </p>

                            <a href='#' class='btn'>Read Alven magazine</a>
                        </div>
                    </div>

                    <div class='main-spotlight-post'>
                        <div class='container'>
                            <div class='img img-fit col-6'>
                                <img src='img/captaintrain.jpg' alt='' class='no-scroll'>
                            </div><div class='txt col-4'>
                                <h3><a href='#'>Captain Train and Trainline combine strengths</a></h3>
                                <div class='post-meta-spotlight'>
                                    <a href='#' class='btn-cat'>News</a> -
                                    <time datetime='2016-05-04'>May 4th 2016</time>
                                </div>
                                <p>
                                    <strong>Train to the Moon!</strong> Alven Capital is proud to announce the successful acquisition of one its portfolio companies, Captain Train. The transaction rewards 5 years of steady growth for Captain Train who has risen to become the go-to alternative in France...
                                </p>
                                <a href='#' class='btn-arrow'>Read</a>
                            </div>
                        </div>
                    </div>

                    <div class='content-footer read-also-posts' id='related'>
                        <div class='container'>
                            <div class='grid'>
                                <div class='col-4 read-also-post'>
                                    <h4><a href='#'>Drivy continues its unstoppable rise with a $35M round</a></h4>
                                    <div class='post-meta'>
                                        <a href='#' class='btn-cat'>News</a> -
                                        <time datetime='2016-05-04'>May 4th 2016</time>
                                    </div>
                                    <a href='#' class='btn-arrow'>Read</a>
                                </div><div class='col-4 read-also-post'>
                                    <h4><a href='#'>Getting 100+ pitch emails a day: how not to miss the hidden gem?</a></h4>
                                    <div class='post-meta'>
                                        <a href='#' class='btn-cat'>News</a> -
                                        <time datetime='2016-05-04'>May 4th 2016</time>
                                    </div>
                                    <a href='#' class='btn-arrow'>Read</a>
                                </div><div class='col-4 read-also-post'>
                                    <h4><a href='#'>The new technologies evolutionary path from utility to fashion</a></h4>
                                    <div class='post-meta'>
                                        <a href='#' class='btn-cat'>News</a> -
                                        <time datetime='2016-05-04'>May 4th 2016</time>
                                    </div>
                                    <a href='#' class='btn-arrow'>Read</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='spotlight-posts' id='spotlightPost'>
                        <div class='container' id='spotlightDrag'>
                            <div class='grid'>
                                <div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>Android Dev</a></h4>
                                            <p>
                                                {<br>
                                                var:= your.Java Skill;<br>
                                                if Years.worked > 3<br>
                                                then Apply here<br>
                                                else<br> ...
                                            </p>
                                            <a href='#' class='btn-arrow'>Let's start coding</a>
                                        </div>
                                    </div>
                                </div><div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>COO wanted</a></h4>
                                            <p>
                                                <strong>You are a humble yet efficient executive leading by example?</strong><br><br>
                                                You have nurtured teams and grown company 2-5x in a few years?
                                            </p>
                                            <a href='#' class='btn-arrow'>You're the one</a>
                                        </div>
                                    </div>
                                </div><div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>Growth vs. profits</a></h4>
                                            <p>
                                                n.m.: An exit is the way a successful company is sold to a third party by its initial team of founders and ...
                                            </p>
                                            <a href='#' class='btn-arrow'>Full definition</a>
                                        </div>
                                    </div>
                                </div><div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>Reading list March 2016</a></h4>
                                            <p>
                                                Articles from around the web that smart people should read:
                                            </p>
                                            <ul>
                                                <li><a href='#'>Feeds vs. Streams</a></li>
                                                <li><a href='#'>How to create a culture of growth</a></li>
                                            </ul>
                                            <p>...</p>
                                            <a href='#' class='btn-arrow'>The entire list</a>
                                        </div>
                                    </div>
                                </div><div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>Demo Day July 17th - 7pm Paris</a></h4>
                                            <p>
                                                15 startups are pitching and networking.<br><br>
                                                In Paris, 15 rue des 4 vents ...
                                            </p>
                                            <a href='#' class='btn-arrow'>Details</a>
                                        </div>
                                    </div>
                                </div><div class='col-2 spotlight-post'>
                                    <div>
                                        <div class='content'>
                                            <h4><a href='#'>Innov&Connect Forum 2016 - May 15th</a></h4>
                                            <p>
                                                You have nurtured teams and grown company 2-5x in a few years?
                                            </p>
                                            <a href='#' class='btn-arrow'>Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='newsletter'>
                        <div class='container'>
                            <div class='grid'>
                                <div class='col-6 newsletter-title'>
                                    <h3>
                                        Get some more fresh&nbsp;news&nbsp;?
                                    </h3><!--
                                    --><p>
                                        Signup for our newsletter and be in the&nbsp;loop!
                                    </p>
                                </div><form method='post' action='' class='col-5'>
                                    <fieldset>
                                        <input type='email' name='email' id='email' required>
                                        <label for='email'>Your email</label>
                                    </fieldset><button type='submit' class='btn-invert'>Signup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>


                <section class='theme-portfolio'>
                    <h2 class='section-title'>Portfolio</h2>
                    <strong class='subtitle'>What we fund, what we funded</strong>
                    <div class='container'>
                        <div class='section-header'>
                            <p>Alven Capital has backed more than 80 companies during the last 15 years, and currently owns active investments in the Internet, media and IT sectors.</p>
                        </div>
                    </div>
                    <div class='portfolio-list' id='portfolio'>
                        <div class='container'>
                            <ul class='grid'>
                                <li class='col-2'>
                                    <a href='#'>
                                        <svg class='svg-openclassrooms' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 2355 1485" style="enable-background:new 0 0 2355 1485;" xml:space="preserve">
                                        <g>
                                            <path class="st0 zone-svg" d="M1769,1485c-2.8-0.7-5.6-1.5-8.4-2.2c-20-5.5-32.9-18.3-36.4-38.7c-5.2-31.2-5-62.8-1.1-94
                                                c3.4-27.4,22.2-42.8,49.9-44.8c9.3-0.7,18.6-0.1,27.7,2.4c24.8,6.9,35.9,24.9,37.8,48.9c2.2,27.2,2.8,54.6-0.6,81.8
                                                c-3.2,25.8-19.7,41.9-45.4,45.8c-0.9,0.1-1.7,0.6-2.6,1C1783,1485,1776,1485,1769,1485z M1800,1393.4
                                                C1800,1393.4,1800.1,1393.4,1800,1393.4c0.1-12.7,0.4-25.3,0-38c-0.3-12.7-7.1-18.8-19.7-18.6c-12.3,0.2-20,7.7-20.2,21.2
                                                c-0.4,22-0.3,44-0.2,66c0,4.5,0.4,9,1.2,13.4c1.9,10.8,8.3,16.1,18.9,16.1c12.3,0.1,19.4-6.8,19.9-20.6
                                                C1800.4,1419.8,1800,1406.6,1800,1393.4z"/>
                                            <path class="st0 zone-svg" d="M1925,1485c-2.8-0.8-5.6-1.5-8.4-2.3c-20.4-5.7-33.2-18.9-36.4-39.8c-4.8-31.3-4.7-62.9-0.7-94.1
                                                c4-30.9,31.6-47.9,66-43.3c30.9,4.1,47.7,21.5,49.5,52.7c1.6,26.7,2.8,53.7-0.8,80.3c-3.7,27-19.3,41.4-46.5,45.7
                                                c-0.6,0.1-1.1,0.5-1.6,0.8C1939,1485,1932,1485,1925,1485z M1956.1,1393.5c0,0,0.1,0,0.1,0c0-12.7,0.5-25.3-0.1-38
                                                c-0.7-14-7.5-19.5-21.5-18.5c-10.7,0.7-17.8,7.2-18.1,20c-0.7,25.8-1.6,51.7,0.5,77.4c1.2,13.8,8,19.5,20.6,19.1
                                                c11.2-0.4,17.9-7.2,18.4-20.5C1956.5,1419.8,1956.1,1406.6,1956.1,1393.5z"/>
                                            <path class="st1 zone-svg" d="M243,1485c-3.8-1-7.6-1.9-11.3-3.1c-20.9-6.6-31.8-21.6-34.6-42.7c-3.7-28.7-3.5-57.6-0.8-86.2
                                                c3.2-33.4,30.5-52.2,66.5-47.6c29.8,3.8,45.8,18.6,49.1,48.6c3.1,28.5,3.2,57.2-0.3,85.7c-3,24.6-20,40.5-44.6,44.3
                                                c-1.1,0.2-2.1,0.7-3.1,1C257,1485,250,1485,243,1485z M274,1393.5C274,1393.5,274,1393.5,274,1393.5c0-12.8,0.3-25.7,0-38.5
                                                c-0.3-12-6.7-17.9-18.6-18.2c-12.4-0.3-20.8,6.6-21.1,19.6c-0.5,25.3-0.2,50.6,0,75.9c0,2.8,0.9,5.6,1.7,8.3
                                                c2.6,8.6,7.9,12.6,16.8,12.8c13.1,0.4,20.5-6.6,21.1-21C274.4,1419.5,274,1406.5,274,1393.5z"/>
                                            <path class="st0 zone-svg" d="M1471,1485c-2.3-0.6-4.6-1.4-7-1.9c-18.2-3.6-30.2-15.1-39.2-30.5c-1.1-1.9-0.9-2.8,0.9-3.9
                                                c8.4-5.4,16.7-10.9,24.9-16.6c3.1-2.1,3.2,0.6,4.1,2.1c9.1,16,23.7,23.2,38.9,18.8c7.7-2.2,13.4-6.7,14.4-15.3
                                                c1.1-9.5-1.7-15-10.8-19.2c-13.3-6.1-27.1-11.1-40.1-17.6c-27.7-13.7-38.2-43.6-25-69.7c8.3-16.4,22.9-23.6,40.3-25.8
                                                c26.8-3.3,49.3,4.4,65.7,26.9c2.2,3,1.8,4.1-1.1,5.9c-7.3,4.6-14.6,9.3-21.6,14.3c-2.8,2-3.9,1.3-5.7-1.3
                                                c-7.8-11.3-18.3-17.2-32.4-15.4c-7.4,1-12.7,4.7-14.6,12.3c-1.9,7.6,1,13.6,7.2,17.7c11.2,7.4,24.4,10.3,36.8,15.1
                                                c31.6,12.1,45.9,41.1,34.4,71.2c-7.2,18.8-22.2,27.9-41,31.8c-1.1,0.2-2.1,0.7-3.1,1.1C1488.3,1485,1479.7,1485,1471,1485z"/>
                                            <path class="st0 zone-svg" d="M2280,1485c-1.4-1.9-3.6-1.4-5.4-1.8c-18.4-3.6-30.4-15.4-39.6-30.9c-1.5-2.6,0.4-3.1,1.8-4
                                                c7.7-5.2,15.6-10.2,23.3-15.5c2.8-2,3.7-1.4,5.2,1.5c8.4,15.7,23.3,22.9,38.5,18.8c8.8-2.3,13.9-7.8,15-16.1
                                                c1.1-8.3-1.9-14.2-10.7-18.3c-13.5-6.3-27.7-11.4-41-18c-28-14-38.2-46.7-22.8-72.2c8.6-14.2,22.1-20.7,38-22.8
                                                c27-3.6,49.6,4,66.4,26.5c2.3,3,2,4.3-1.2,6.3c-7.2,4.4-14.3,9.1-21.2,14.1c-2.9,2.1-4,1.5-6-1.3c-7.6-10.9-17.8-16.8-31.5-15.3
                                                c-7.6,0.8-13.2,4.4-15.4,12.1c-2,7.3,1,14.2,8.2,18.7c8.7,5.5,18.6,7.8,28.1,11.4c8.1,3.1,16.1,6.2,23.4,10.9
                                                c12.3,7.8,18.2,19.7,22,33c0,6,0,12,0,18c-2.8,16.1-10.6,28.8-25,37.1c-7.5,4.3-15.8,5.9-24,7.9C2297.3,1485,2288.7,1485,2280,1485
                                                z"/>
                                            <path class="st0 zone-svg" d="M1328,1485c-11.4-2.8-22.7-5.6-31.7-14c-5.7-5.3-10.1-11.4-14.3-17.9c-1.6-2.5-0.8-3.7,1.4-5
                                                c7.7-5,15.4-9.9,22.9-15.2c2.9-2.1,4-1.8,5.7,1.4c8.1,15.6,23,22.8,38.4,18.6c7.8-2.1,13.4-6.7,14.6-15.1c1.3-9.1-1.3-14.8-10.3-19
                                                c-12.1-5.7-24.8-10.4-37-15.9c-28.6-13-40.6-38.9-30.7-66.5c7-19.7,22.8-28.4,42.3-30.9c26.8-3.5,49.3,4.4,65.8,26.8
                                                c2.1,2.9,2,4.1-1.1,6c-7.3,4.6-14.5,9.4-21.6,14.3c-2.6,1.8-3.7,1.7-5.7-1.2c-7.8-11.5-18.5-17.5-32.8-15.4
                                                c-7.2,1.1-12.3,4.7-14.1,12.2c-1.8,7.4,0.8,13.2,6.7,17.4c8.8,6.3,19.4,8.5,29.2,12.4c6.6,2.6,13.4,4.8,19.6,8.5
                                                c20.2,11.9,29.2,31.3,25.6,55.6c-3,20.1-18.3,35.8-39.9,41c-2.3,0.6-4.6,1.3-7,2C1345.3,1485,1336.7,1485,1328,1485z"/>
                                            <path class="st0 zone-svg" d="M882,1485c-5.8-1.7-11.9-2.7-17.4-5.1c-17.6-7.7-27.9-21.4-29.8-40.5c-2.9-29.2-3.5-58.7-0.2-87.7
                                                c3.5-30.5,24.5-46.4,57.6-47.1c8.7-0.2,17.3,0.8,25.6,3.7c25.6,8.9,31.2,29.9,32.3,52.6c0.2,3.2-2.1,2.3-3.7,2.4
                                                c-10,0-20-0.1-30,0.1c-3.4,0.1-4.3-0.7-4.5-4.3c-0.5-14.8-7.3-22.8-18.9-22.8c-10.8,0-19.4,6.8-20,17.6
                                                c-1.4,27.3-1.6,54.6,0.1,81.9c0.7,10.7,7.5,16.3,18.6,17.2c9.3,0.8,16.5-4.4,19.3-14.4c1-3.7,2-7.6,1.8-11.3
                                                c-0.3-5.2,1.8-5.9,6.3-5.7c9.5,0.3,19,0.1,28.5,0.1c1.8,0,3.7-0.4,3.7,2.5c-0.2,18.1-2.9,35.2-17.7,47.9c-8.1,7-17.6,10.5-28,12.1
                                                c-0.9,0.1-2.1-0.4-2.5,1C896,1485,889,1485,882,1485z"/>
                                            <path class="st1 zone-svg" d="M400,0c1.7,27.2,3.3,54.4,5.1,81.6c0.2,3.5-0.4,5.2-4.2,6.2c-33.6,8.7-67.1,17.6-100.6,26.7
                                                c-3.8,1-5,0.1-5.4-3.6c-0.4-3.6-0.7-7.4-2.1-10.7c-4.7-11.2,0-18.2,8.2-25.8C331.3,46.3,364,21.6,399,0C399.3,0,399.7,0,400,0z"/>
                                            <path class="st2 zone-svg" d="M0,423c2.9-18.4,10.4-34.8,21.8-49.5c5.9-7.7,17-8.5,23-1.3c15.7,18.7,31.3,37.5,47.1,56.2
                                                c2.6,3,2.3,3.9-1.7,4.8c-28.6,6.6-57.2,13.5-85.8,20.3c-1.4,0.3-3,0.3-4.4,0.5C0,443.7,0,433.3,0,423z"/>
                                            <path class="st3 zone-svg" d="M2355,883c-2.8,7.6-8.7,8.2-15.9,8c-20.5-0.4-41-0.3-61.5-0.1c-4,0-5-1.2-4.9-5c0.2-16.5,0.1-33,0.1-50.3
                                                c4.1,2.3,7.7,4.2,11.2,6.2c22,12.4,44,24.9,66.1,37.2c1.5,0.8,2.8,2.5,4.9,1.9C2355,881.7,2355,882.3,2355,883z"/>
                                            <path class="st0 zone-svg" d="M2167.8,1339.6c-5.6,22.1-10.7,42.3-15.8,62.5c-6.2,24.7-12.5,49.3-18.5,74c-0.8,3.2-1.9,4.3-5.3,4.2
                                                c-7.3-0.4-16.5,2.3-21.4-1.2c-4.5-3.3-4.4-13-6.2-19.9c-10-38.6-19.9-77.2-29.9-115.8c-0.3-1.2-0.7-2.4-0.8-2.6
                                                c0,11.9,0,24.7,0,37.5c0,32.8,0,65.6,0.2,98.5c0,3-1,3.5-3.7,3.5c-8.5-0.2-17-0.2-25.5,0c-2.9,0.1-3.6-1-3.6-3.7
                                                c0.1-54.8,0.1-109.6,0-164.5c0-3,0.8-4,3.9-4c14.5,0.2,29,0.2,43.5,0c3.5-0.1,4.1,1.8,4.8,4.3c9.5,35,20.7,69.4,28.7,104.8
                                                c0.1,0.6,0.5,1.1,1.3,2.9c4.8-26.4,12.5-50.9,19.4-75.5c3.1-10.9,6.2-21.7,9.2-32.6c0.7-2.8,1.9-3.9,5-3.9c14.3,0.2,28.7,0.2,43,0
                                                c3.3,0,4.1,0.9,4.1,4.2c-0.1,54.7-0.1,109.3,0,164c0,3.4-1.1,4.1-4.2,4c-8.3-0.2-16.7-0.2-25,0c-3.3,0.1-4.1-0.8-4.1-4.1
                                                c0.5-44.1-0.9-88.3,1.5-132.4C2168.5,1343,2168.2,1342.3,2167.8,1339.6z"/>
                                            <path class="st1 zone-svg" d="M701.4,1369.5c1.4,35,0.1,69.9,0.7,104.8c0.1,4.8-1,6.3-5.9,6c-8.5-0.5-17-0.2-25.5-0.1
                                                c-2.9,0.1-3.6-0.9-3.6-3.7c0.1-54.8,0.1-109.6,0-164.4c0-3.6,1.4-4,4.4-4c8.8,0.2,17.7,0.3,26.5,0c4-0.1,6.2,1.1,8.1,4.7
                                                c16.9,32,35.8,62.9,50.7,94.3c0-9.4,0-20.1,0-30.9c-0.1-21.5-0.1-43-0.3-64.5c0-3,1.2-3.6,3.9-3.5c9.2,0.1,18.3,0.2,27.5,0
                                                c3.3-0.1,3.8,1.3,3.8,4.1c-0.1,54.6-0.1,109.3,0,163.9c0,3.4-1.1,4.2-4.3,4.1c-7.5-0.2-15-0.3-22.5,0c-3.5,0.1-5.3-1.1-6.9-4.2
                                                C739.4,1440.5,717.8,1406.4,701.4,1369.5z"/>
                                            <path class="st0 zone-svg" d="M1699,1480.2c-13.3,0-26.1-0.1-38.9,0c-3.1,0-3.3-2.3-4.1-4.2c-9.7-20.8-19.4-41.5-28.8-62.4
                                                c-3-6.5-8.3-3.3-12.4-3.4c-3.5,0-1.6,4-1.6,6c-0.2,20-0.2,40,0,60c0,2.9-0.5,4-3.8,4c-10-0.2-20-0.2-30,0c-3.1,0.1-3.9-0.9-3.9-3.9
                                                c0.1-54.6,0.1-109.3,0.1-163.9c0-1.7-1-4.3,2.5-4.2c25.4,0.7,51-1.8,76.3,1.8c23.5,3.3,37,16.7,39.6,38.2
                                                c3.4,28.4-5.6,45.6-28.9,54.7c-3.7,1.4-2.4,2.8-1.3,5c11.2,22.8,22.4,45.6,33.5,68.5C1697.8,1477.4,1698.3,1478.6,1699,1480.2z
                                                 M1613,1358.6c0,2.5,0,5,0,7.5c0,17.3,0,17.3,17.6,16.1c20.5-1.3,26.9-9.1,24.6-29.6c-1.2-10.2-6.4-15.7-16.6-16.6
                                                c-7.3-0.7-14.6-0.4-21.9-0.9c-3.3-0.2-3.8,1.1-3.8,4C1613.1,1345.6,1613,1352.1,1613,1358.6z"/>
                                            <path class="st1 zone-svg" d="M509.2,1393.8c0-27,0.1-54-0.1-81c0-3.6,0.7-4.8,4.6-4.8c35.5,0.2,71,0.1,106.4,0c3.6,0,5,0.8,4.8,4.6
                                                c-0.3,7.5-0.3,15,0,22.5c0.1,3.7-1,4.8-4.7,4.7c-23-0.2-46,0-69-0.2c-3.4,0-4.6,0.7-4.5,4.3c0.3,9.3,0.2,18.7,0,28
                                                c-0.1,3.3,0.9,4.2,4.2,4.1c15-0.2,30,0.1,45-0.2c3.8-0.1,4.8,1.1,4.7,4.8c-0.3,7.5-0.3,15,0,22.5c0.2,3.9-1.2,4.7-4.9,4.6
                                                c-14.8-0.2-29.7,0-44.5-0.2c-3.3,0-4.3,0.9-4.2,4.2c0.2,10.5,0.3,21,0,31.5c-0.1,3.8,1,4.7,4.7,4.7c24.7-0.2,49.3,0,74-0.2
                                                c3.4,0,4.6,0.6,4.5,4.3c-0.3,8-0.2,16,0,24c0.1,2.9-0.5,4.1-3.8,4c-37.8-0.1-75.6-0.1-113.4,0c-3.6,0-3.9-1.5-3.9-4.4
                                                C509.2,1448.5,509.2,1421.2,509.2,1393.8z"/>
                                            <path class="st4 zone-svg" d="M1281,835.4c0,17.7-0.1,35.3,0.1,53c0,3.3-0.9,4.2-4.2,4.2c-35-0.1-70-0.1-105,0c-3.3,0-4.2-0.9-4.2-4.2
                                                c0.2-35.6,0.2-71.3,0.2-106.9c0-2.8,0.7-3.7,3.6-3.7c35.3,0.1,70.6,0.1,106,0c3.5,0,3.6,1.6,3.6,4.2
                                                C1281,799.8,1281,817.6,1281,835.4z"/>
                                            <path class="st2 zone-svg" d="M1715.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.8,5.1c-0.1,34.3-0.2,68.6,0,103c0,4.6-1.4,5.5-5.6,5.4
                                                C1749.5,1013.5,1732.5,1013.7,1715.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M598.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.9,5.1c-0.1,34.5-0.1,69,0,103.5c0,4.1-1.3,4.9-5.1,4.9
                                                C632.8,1013.6,615.7,1013.7,598.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M2027.1,956.9c0-17.3,0.1-34.7-0.1-52c0-3.6,0.8-4.9,4.7-4.9c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1,4.5,4.5
                                                c-0.1,34.8-0.1,69.7,0,104.5c0,3.9-1.3,4.7-4.9,4.7c-34.3-0.1-68.7-0.1-103,0c-4.2,0-5.4-1.2-5.3-5.3
                                                C2027.3,991.2,2027.1,974.1,2027.1,956.9z"/>
                                            <path class="st5 zone-svg" d="M606,783.5c-3.8,35.6-7.5,70.9-11.2,106.1c-0.3,2.9-1.4,3.5-4.1,3.2c-35.1-4-70.1-7.9-105.2-11.7
                                                c-2.3-0.3-3.6-0.5-3.3-3.4c3.9-35.4,7.8-70.8,11.5-106.2c0.3-3.1,1.2-3.8,4.2-3.5c34.7,3.9,69.5,7.7,104.2,11.5
                                                C604.9,779.9,607.2,780.2,606,783.5z"/>
                                            <path class="st2 zone-svg" d="M1101.9,532.3c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.9,0.9,4.8,4.7c-0.1,34.6-0.1,69.3,0,103.9
                                                c0,3.7-1,4.8-4.7,4.8c-33.6-0.1-67.3-0.2-101,0c-4.3,0-4.4-1.8-4.8-5.3c-4-34.4-2.4-68.8-2.8-103.3c0-4,1.2-5,5-5
                                                C1067.3,532.5,1084.6,532.3,1101.9,532.3z"/>
                                            <path class="st6 zone-svg" d="M735.1,335.5c0.4,3.2-2.6,2.9-4.4,3.4C699.1,347,667.6,355,636,363c-9.8,2.5-9.8,2.4-12.3-7.5
                                                c-8-31.4-15.9-62.8-24.1-94.2c-1.1-4.3-0.1-5.7,4.1-6.8c33.6-8.4,67-16.9,100.5-25.6c2.7-0.7,3.8-0.3,4.5,2.4
                                                c8.6,34.2,17.4,68.3,26.1,102.5C734.9,334.4,735,334.9,735.1,335.5z"/>
                                            <path class="st6 zone-svg" d="M2140.1,343.5c0,17.3-0.1,34.7,0.1,52c0,3.4-0.8,4.6-4.4,4.6c-34.8-0.1-69.7-0.1-104.5,0
                                                c-3.4,0-4.2-1.1-4.2-4.3c0.1-34.8,0.1-69.7,0-104.5c0-3.2,0.8-4.3,4.2-4.3c34.8,0.1,69.7,0.1,104.5,0c3.6,0,4.5,1.2,4.4,4.6
                                                C2140,308.8,2140.1,326.2,2140.1,343.5z"/>
                                            <path class="st7 zone-svg" d="M2263,343.5c0,17.5-0.1,35,0.1,52.4c0,3.3-0.9,4.1-4.2,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-1-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.1C2262.9,308.5,2263,326,2263,343.5z"
                                                />
                                            <path class="st7 zone-svg" d="M1101.5,409.8c17.3,0,34.7,0.1,52-0.1c3.6,0,4.8,0.8,4.8,4.6c-0.2,34.7-0.1,69.3,0,104c0,3.4-0.7,4.6-4.4,4.6
                                                c-34.8-0.1-69.7-0.1-104.5,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.8,1.4-4.3,4.6-4.2
                                                C1066.8,409.9,1084.2,409.8,1101.5,409.8z"/>
                                            <path class="st4 zone-svg" d="M1281,466.5c0,17.3-0.1,34.6,0.1,52c0,3.4-0.7,4.5-4.3,4.5c-34.8-0.1-69.6-0.2-104.4,0c-4,0-4.6-1.3-4.6-4.8
                                                c0.1-34.6,0.1-69.3,0-103.9c0-3.5,0.9-4.4,4.4-4.4c34.8,0.1,69.6,0.2,104.4,0c4,0,4.5,1.3,4.5,4.8
                                                C1280.9,431.8,1281,449.2,1281,466.5z"/>
                                            <path class="st6 zone-svg" d="M1592,522.9c-17,0-34-0.1-50.9,0.1c-4,0-5-1.1-5-5.1c0.1-34.5,0.1-68.9,0-103.4c0-3.6,1-4.9,4.8-4.9
                                                c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,1.1,4.5,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.9-4.8,4.8
                                                C1626.9,522.8,1609.5,522.9,1592,522.9z"/>
                                            <path class="st7 zone-svg" d="M1715.5,522.8c-17.3,0-34.6-0.1-52,0.1c-3.8,0-4.7-1.1-4.6-4.8c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.6,0.7-4.8,4.6-4.8c34.6,0.2,69.3,0.2,103.9,0c3.8,0,4.7,1.1,4.6,4.8c-0.1,34.6-0.2,69.3,0,103.9c0,4.3-1.5,4.8-5.1,4.8
                                                C1749.8,522.8,1732.7,522.8,1715.5,522.8z"/>
                                            <path class="st7 zone-svg" d="M1281,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-4-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.2,1-3.8,4-3.8c35,0.1,70,0.1,105,0c3.8,0,4.2,1.4,4.2,4.6C1280.9,677,1281,694.5,1281,712z"/>
                                            <path class="st5 zone-svg" d="M1536.2,711c0-17.1,0.1-34.3-0.1-51.4c0-3.2,0.3-4.6,4.2-4.6c35,0.2,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.2
                                                c-0.1,35-0.1,69.9,0,104.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.2-0.9-4.1-4.2
                                                C1536.2,746.3,1536.2,728.6,1536.2,711z"/>
                                            <path class="st6 zone-svg" d="M1715.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.9-4.8-4.7c0.1-34.7,0.1-69.3,0-104
                                                c0-3.6,1.2-4.5,4.6-4.4c34.7,0.1,69.3,0.1,104,0c3.4,0,4.6,0.8,4.6,4.4c-0.1,34.7-0.1,69.3,0,104c0,3.8-1.2,4.7-4.8,4.7
                                                C1749.9,890.8,1732.6,890.9,1715.3,890.9z"/>
                                            <path class="st6 zone-svg" d="M1045,834.5c0-17.3,0.1-34.6-0.1-52c0-3.8,1.1-4.7,4.8-4.7c34.5,0.1,68.9,0.1,103.4,0c3.9,0,5.1,1,5.1,5
                                                c-0.1,34.5-0.1,68.9,0,103.4c0,3.8-1.2,4.7-4.8,4.7c-34.6-0.1-69.3-0.1-103.9,0c-3.5,0-4.5-1-4.5-4.5
                                                C1045.1,869.1,1045,851.8,1045,834.5z"/>
                                            <path class="st8 zone-svg" d="M1592.6,777.8c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.9,4.2,4.1c-0.1,35-0.1,69.9,0,104.9c0,3.4-1.1,4.1-4.3,4.1
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.6,0-104.4c0-3.7,1.3-4.3,4.6-4.3
                                                C1558,777.9,1575.3,777.8,1592.6,777.8z"/>
                                            <path class="st6 zone-svg" d="M922.1,343.5c0-17.2,0.1-34.3-0.1-51.5c0-3.8,0.8-5.2,4.9-5.2c34.5,0.2,68.9,0.2,103.4,0c4,0,5,1.3,5,5.1
                                                c-0.1,34.3-0.1,68.6,0,102.9c0,3.8-0.8,5.2-4.9,5.1c-34.5-0.2-68.9-0.2-103.4,0c-4.1,0-5-1.3-4.9-5.1
                                                C922.2,377.8,922.1,360.7,922.1,343.5z"/>
                                            <path class="st4 zone-svg" d="M1894.8,343.5c0,17.3-0.1,34.7,0.1,52c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-3.9-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.1,0.9-3.8,3.9-3.8c35,0.1,70,0.1,105,0c3.8,0,4.3,1.3,4.2,4.6
                                                C1894.8,308.8,1894.8,326.2,1894.8,343.5z"/>
                                            <path class="st9 zone-svg" d="M1715.5,400c-17.5,0-35-0.1-52.5,0.1c-3.3,0-4.1-0.8-4.1-4.1c0.1-35,0.1-70,0-104.9c0-3.3,0.8-4.1,4.1-4.1
                                                c35,0.1,70,0.1,104.9,0c3.3,0,4.1,0.8,4.1,4.1c-0.1,35-0.1,70,0,104.9c0,3.3-0.8,4.1-4.1,4.1C1750.5,399.9,1733,400,1715.5,400z"/>
                                            <path class="st5 zone-svg" d="M887.2,344c0,17.3-0.1,34.6,0.1,51.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-0.9-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.4,0,4.1,1,4.1,4.2C887.1,308.7,887.2,326.4,887.2,344z"/>
                                            <path class="st10 zone-svg" d="M1101.5,400c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-5.2-0.5-5.2-4.8c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.5,0.9-4.5,4.4-4.4c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.1,4.4,4.5c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.7-4.7,4.7
                                                C1136.2,399.9,1118.8,400,1101.5,400z"/>
                                            <path class="st2 zone-svg" d="M916.6,160.6c-4,30.5-8,61-12.1,91.5c-0.4,2.8-1.3,5.6-1.1,8.4c0.8,9.1-3.8,9.2-11,8.2
                                                c-31.8-4.5-63.6-8.6-95.5-12.7c-4.8-0.6-6.9-1.4-6.1-7.3c4.8-33.8,9.1-67.6,13.4-101.4c0.5-3.8,1.9-4.2,5.5-3.7
                                                c34.1,4.6,68.3,9,102.4,13.5C914.1,157.4,917.3,156.7,916.6,160.6z"/>
                                            <path class="st10 zone-svg" d="M395.9,718.1c-24.6,2.4-49.3,4.7-73.9,7.2c-3.3,0.3-4.7-0.3-5-4c-3.3-34.7-6.8-69.5-10.4-104.2
                                                c-0.3-3.2,0.3-3.9,3.4-4.2c35.1-3.5,70.1-7,105.2-10.7c2.8-0.3,3.7,0.4,4,3.3c2.2,23.2,4.6,46.3,7,69.5c1.2,11.5,2.2,23,3.6,34.5
                                                c0.4,3.6,0.3,5.4-4.2,5.6C415.6,715.7,405.8,717.1,395.9,718.1z"/>
                                            <path class="st0 zone-svg" d="M1244.6,1479.9c-6,0-13.6,2.2-17.5-0.6c-3.8-2.8-3.7-10.8-5.2-16.5c-4.2-16.5-4.2-16.5-21.5-16.5
                                                c-10.3,0-20.7,0.2-31-0.1c-3.4-0.1-4.6,1.2-5.3,4.2c-2.2,8.9-4.7,17.7-6.8,26.6c-0.6,2.7-1.6,3.5-4.3,3.4c-10-0.1-20-0.2-30,0
                                                c-3.2,0.1-3.5-1-2.8-3.8c15.6-55,31.1-110,46.6-165c0.7-2.6,1.8-3.4,4.4-3.4c13,0.1,26,0.1,39,0c2.7,0,3.8,0.9,4.5,3.4
                                                c15.8,55.1,31.7,110.1,47.7,165.2c0.9,3.2,0,3.7-2.8,3.6c-5-0.2-10,0-15,0C1244.6,1480.1,1244.6,1480,1244.6,1479.9z
                                                 M1190.9,1337.8c-6.4,26.8-12.3,51.4-18.3,75.8c-0.8,3.1,0.3,3.3,2.8,3.2c7-0.1,14,0,21,0c13.9,0,13.9,0,10.6-13.4
                                                C1201.8,1382.3,1196.6,1361.3,1190.9,1337.8z"/>
                                            <path class="st7 zone-svg" d="M507.7,489.2c-4.8,1.9-5.7-1.1-6.2-6.1c-3-33.7-6.2-67.3-9.6-100.9c-0.4-4.2,0.9-5.1,4.9-5.5
                                                c33.5-3,67-6.2,100.4-9.6c5.1-0.5,7.2,0.3,7.7,5.9c2.9,33.8,6.1,67.7,9.3,101.5c0.4,3.7-0.4,4.8-4.1,5.2
                                                C576.3,482.6,542.5,485.9,507.7,489.2z"/>
                                            <path class="st7 zone-svg" d="M2150,957c0-17.5,0.1-35-0.1-52.5c0-3.5,0.9-4.5,4.4-4.4c34.7,0.1,69.3,0.1,104,0c3.6,0,4.8,0.7,4.8,4.6
                                                c-0.2,31.8-0.1,63.6-0.1,95.5c0,4.9-8.2,13.3-13.3,13.3c-32,0-64,0-96,0.1c-3.8,0-3.8-1.8-3.8-4.6C2150,991.7,2150,974.3,2150,957z
                                                "/>
                                            <path class="st4 zone-svg" d="M1158.2,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-104.9,0c-3.2,0-4.2-0.6-4.2-4
                                                c0.2-25.7-0.2-51.3,0.2-77c0.1-9.8,1.7-19.5,2.5-29.3c0.2-2.5,1.5-2.8,3.6-2.8c34.5,0,69,0.1,103.4,0c3.4,0,3.6,1.4,3.6,4.1
                                                C1158.1,676.7,1158.2,694.4,1158.2,712z"/>
                                            <path class="st4 zone-svg" d="M1649.2,589c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.7,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0c-4.1,0-4.9-1.3-4.9-5.1
                                                c0.1-34.3,0.1-68.6,0-103c0-3.8,0.9-5.1,4.9-5.1c34.5,0.2,69,0.2,103.5,0c4.2,0,4.8,1.5,4.8,5.1
                                                C1649.1,554.7,1649.2,571.9,1649.2,589z"/>
                                            <path class="st7 zone-svg" d="M1838,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.6,0-4.9-0.7-4.8-4.6c0.2-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.3,4.4,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,4-1.6,4.6-5,4.5
                                                C1872.6,1013.4,1855.3,1013.4,1838,1013.4z"/>
                                            <path class="st6 zone-svg" d="M1224.6,645.2c-17.3,0-34.7-0.1-52,0.1c-3.7,0-4.8-1.1-4.8-4.8c0.1-34.3,0.1-68.6,0-103c0-3.7,1-4.9,4.8-4.8
                                                c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1.1,4.5,4.5c-0.1,34.5-0.1,69,0,103.5c0,4-1.5,4.6-5,4.6
                                                C1258.9,645.2,1241.8,645.2,1224.6,645.2z"/>
                                            <path class="st9 zone-svg" d="M1158.2,957.5c0,17.2-0.1,34.3,0.1,51.5c0,3.3-0.5,4.6-4.2,4.6c-35-0.1-69.9-0.1-104.9,0
                                                c-3.3,0-4.2-0.8-4.1-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.8,0,4.2,1.4,4.2,4.6
                                                C1158.1,922.5,1158.2,940,1158.2,957.5z"/>
                                            <path class="st7 zone-svg" d="M733.1,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.5,0-4.9-0.6-4.9-4.6c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.9,1.3-4.6,4.8-4.6c34.5,0.1,68.9,0.1,103.4,0c4,0,5,1.2,5,5.1c-0.1,34.3-0.2,68.6,0,102.9c0,4.4-1.5,5.1-5.4,5.1
                                                C767.4,1013.3,750.2,1013.4,733.1,1013.4z"/>
                                            <path class="st4 zone-svg" d="M922.2,956.5c0-17.2,0.1-34.3-0.1-51.5c0-3.4,0.8-4.6,4.4-4.6c34.8,0.1,69.6,0.1,104.4,0
                                                c3.3,0,4.7,0.6,4.6,4.3c-0.1,34.8-0.1,69.6,0,104.4c0,3.1-0.7,4.3-4.1,4.3c-35-0.1-70-0.1-104.9,0c-3.6,0-4.4-1.2-4.4-4.6
                                                C922.2,991.5,922.2,974,922.2,956.5z"/>
                                            <path class="st10 zone-svg" d="M1960.8,400c-17.1,0-34.3-0.1-51.4,0.1c-3.7,0-4.8-0.9-4.8-4.7c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,0.9,4.5,4.5c-0.1,34.8-0.1,69.6,0,104.4c0,3.8-1.5,4.3-4.7,4.3
                                                C1995.4,399.9,1978.1,400,1960.8,400z"/>
                                            <path class="st6 zone-svg" d="M2017.2,956.8c0,17.2-0.1,34.3,0.1,51.5c0,4-1.2,5.1-5.1,5.1c-34.1-0.1-68.3-0.1-102.4,0
                                                c-3.9,0-5.1-1.1-5.1-5.1c0.1-34.5,0.1-69,0-103.4c0-3.8,1.2-4.8,4.8-4.8c34.3,0.1,68.6,0.1,102.9,0c3.7,0,4.9,1,4.8,4.8
                                                C2017.1,922.1,2017.2,939.5,2017.2,956.8z"/>
                                            <path class="st7 zone-svg" d="M2017.2,166.1c0.1,36,0.2,71.9,0.3,107.9c0,2.5-1,3-3.3,3c-35.5-0.1-70.9-0.1-106.4,0c-2.7,0-3.3-1-3.3-3.5
                                                c0.1-35.3,0.1-70.6,0-105.9c0-2.8,0.7-3.7,3.6-3.7c32.6,0.2,65.3,0.2,97.9,0.3C2009.8,164.8,2013.5,165.5,2017.2,166.1z"/>
                                            <path class="st6 zone-svg" d="M912.2,957.5c0,17-0.1,34,0.1,51c0,3.7-1.1,4.8-4.8,4.8c-34.3-0.1-68.6-0.1-103,0c-3.7,0-4.8-1.1-4.8-4.8
                                                c0.1-34.3,0.1-68.6,0-103c0-3.7,1.1-4.8,4.8-4.8c34.3,0.1,68.6,0.1,103,0c3.7,0,4.9,1.1,4.8,4.8
                                                C912.1,922.9,912.2,940.2,912.2,957.5z"/>
                                            <path class="st1 zone-svg" d="M354.5,1394.1c0-27,0.1-54-0.1-80.9c0-3.7,0.7-5.2,4.9-5.1c24.4,0.9,49-1.9,73.3,1.9
                                                c28.2,4.4,43.5,24.2,42.6,54c-0.9,28.4-18,47.3-45.6,50c-10.7,1.1-21.6,1.4-32.4,1.7c-3.6,0.1-4.4,1.1-4.4,4.5
                                                c0.1,18.5,0,37,0.1,55.5c0,3.4-0.8,4.6-4.4,4.5c-9.8-0.2-19.7-0.3-29.5,0c-3.8,0.1-4.7-1-4.7-4.7
                                                C354.5,1448.4,354.5,1421.2,354.5,1394.1z M392.8,1361.8c0,7.3,0.1,14.6,0,22c0,2.2,0.3,3.4,2.9,3.3c7.3-0.4,14.7-0.2,21.9-1.1
                                                c10.8-1.3,17.5-10.6,17.9-23.5c0.5-15.1-4.1-22.1-16.2-24.6c-7.4-1.5-14.9-0.6-22.4-1c-3.2-0.2-4.3,0.7-4.2,4.1
                                                C393,1347.8,392.8,1354.8,392.8,1361.8z"/>
                                            <path class="st8 zone-svg" d="M856.3,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.8,0.8,4.8,4.7c-0.1,33-0.2,66,0,98.9c0,3.9-1.2,5-5,5.4
                                                c-34.2,3.3-68.4,3.6-102.7,1c-4.4-0.3-5.5-1.7-5.5-6c0.2-32.8,0.2-65.6,0-98.4c0-4.8,1.6-5.7,5.9-5.6
                                                C822.3,1023.3,839.3,1023.2,856.3,1023.2z"/>
                                            <path class="st5 zone-svg" d="M302.1,387.8c27.6,2.8,55.3,5.6,82.9,8.2c2.9,0.3,3.1,1.6,2.8,3.9c-3.7,34.7-7.5,69.4-11.1,104.2
                                                c-0.3,3.2-1.4,4.1-4.6,3.8c-35.1-3.7-70.1-7.4-105.2-10.9c-3.9-0.4-3-2.6-2.8-4.8c3.2-29.6,6.4-59.2,9.5-88.8
                                                c0.3-2.5,0.4-5,0.6-7.5c4.2,0.9,8.4,1.8,12.6,2.7C300.8,401.9,300.8,401.9,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M673.1,564.8c-2.8,18.3-3.6,36.9-2.1,55.6c1,12,0.7,12-11.4,13.5c-28.9,3.6-57.8,7.3-86.7,10.9
                                                c-2,0.3-3.6,0.8-4-2.5c-4.4-35.5-8.9-71-13.5-106.5c-0.6-4.3,2.7-3.2,4.5-3.4c22.1-2.9,44.2-5.6,66.4-8.4c12-1.5,24.1-2.9,36.1-4.7
                                                c3.7-0.5,5.3,0.1,5.7,4.2C669.5,537.2,671.3,550.9,673.1,564.8z"/>
                                            <path class="st5 zone-svg" d="M1894.8,220.4c0,17.5-0.1,35,0.1,52.5c0,3.2-0.7,4.2-4.1,4.2c-35-0.1-70-0.1-104.9,0c-3.3,0-4.1-0.8-4.1-4.1
                                                c0.1-30.3,0.1-60.6,0-90.9c0-3.1,1.1-4.2,3.9-5c34.5-9.4,69.5-15.3,105.5-13.1c3.2,0.2,3.8,1.2,3.8,4
                                                C1894.8,185.4,1894.8,202.9,1894.8,220.4z"/>
                                            <path class="st2 zone-svg" d="M553,709.5c0-16.3,0-32.6,0-48.9c0-2.6-0.3-4.6,3.7-4.7c31.8-0.5,63.5-1.1,95.3-1.9c4.2-0.1,5.1,1.2,5.3,5.2
                                                c0.8,13.1,2.1,26.3,6.2,38.8c4.8,14.7,3.1,29.6,3.8,44.5c0.4,6.6,0.3,13.3,0.6,19.9c0.1,2.8-0.8,3.7-3.7,3.8
                                                c-34.9,0.6-69.9,1.2-104.8,2c-3.8,0.1-4.7-1.2-4.7-4.8c0.2-18,0.1-35.9,0.1-53.9C554.2,709.5,553.6,709.5,553,709.5z"/>
                                            <path class="st4 zone-svg" d="M1961.5,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.4,0,4.6,0.8,4.6,4.4c-0.1,31.6-0.1,63.3,0,94.9
                                                c0,3.2-1.2,4.2-4.2,4.7c-34.4,5.4-69.1,7.8-103.9,7.9c-4,0-5-1.2-5-5.1c0.1-34,0.2-67.9,0-101.9c0-4.1,1.3-4.9,5.1-4.9
                                                C1926.9,1023.3,1944.2,1023.2,1961.5,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1838,1023.1c17.5,0,35,0.1,52.5-0.1c3.5,0,4.5,1,4.5,4.5c-0.1,34.1-0.1,68.3,0,102.4c0,2.7-0.3,4.3-3.7,4.2
                                                c-36-1.3-71.5-6.8-106.4-15.7c-2.5-0.6-3-1.9-3-4.2c0.1-29.1,0.1-58.3,0-87.4c0-3.9,2.1-3.7,4.7-3.7
                                                C1803.7,1023.2,1820.8,1023.1,1838,1023.1z"/>
                                            <path class="st8 zone-svg" d="M2140.2,834.3c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.6,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0
                                                c-4.1,0-4.9-1.3-4.9-5.1c0.2-20.2,0.1-40.3,0-60.5c0-2.7,0.5-4.6,2.8-6.3c14.1-10.6,26.2-23.2,36.8-37.1c2.4-3.1,4.8-4.2,8.7-4.2
                                                c19.8,0.2,39.7,0.2,59.5,0c4,0,5.4,0.8,5.3,5.1C2140,800,2140.2,817.2,2140.2,834.3z"/>
                                            <path class="st7 zone-svg" d="M684.1,146c-20.8-3.8-41.4-7.6-62-11.4c-13.9-2.6-27.8-5.2-41.7-7.6c-3.7-0.6-5-1.8-4.2-5.7
                                                c5-26.3,9.9-52.6,14.6-79c0.5-2.9,1.5-4.1,4.6-4.5c32.7-4.7,65.7-5.7,98.7-4.7c12.8,0.4,13.2,0.8,10.9,13.2
                                                c-5.8,31.9-11.7,63.8-17.6,95.7C687,143.9,687.6,146.9,684.1,146z"/>
                                            <path class="st4 zone-svg" d="M1649.2,343.7c0,17.3-0.1,34.7,0.1,52c0,3.5-0.9,4.4-4.4,4.4c-34.8-0.1-69.6-0.1-104.4,0
                                                c-3.7,0-4.4-1.1-4.3-4.5c0.2-18.5,0.1-37,0-55.5c0-2.4,0.5-4.4,2.1-6.4c13.2-15.7,27.3-30.5,42.3-44.5c1.6-1.5,3.3-2.4,5.7-2.4
                                                c19.7,0.1,39.3,0.2,59,0c3.6,0,4,1.3,3.9,4.3C1649.1,308.7,1649.2,326.2,1649.2,343.7z"/>
                                            <path class="st8 zone-svg" d="M979,277c-17.5,0-35-0.1-52.5,0.1c-3.5,0-4.5-0.9-4.4-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.7,1.3-4.5,4.6-4.2
                                                c25.3,2.3,49.9,7.9,74.3,14.5c10.4,2.8,20.6,6.4,31,9.4c2.8,0.8,3.6,2.1,3.6,4.9c-0.1,26.7-0.1,53.3,0,80c0,3.7-1.3,4.3-4.6,4.3
                                                C1013.7,276.9,996.3,277,979,277z"/>
                                            <path class="st8 zone-svg" d="M2140.2,466.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.7-4.8,4.6c-19.7-0.2-39.3-0.2-59,0c-3.2,0-5-0.9-6.9-3.6
                                                c-11.3-16.4-24.3-31.3-40.1-43.6c-1.7-1.3-2.5-2.8-2.5-5c0.1-19,0.1-38,0-57c0-3.2,0.8-4.3,4.2-4.3c35,0.1,70,0.1,105,0
                                                c3.5,0,4,1.3,4,4.4C2140.1,431.3,2140.2,448.8,2140.2,466.3z"/>
                                            <path class="st7 zone-svg" d="M1593.1,900.6c17.2,0,34.3,0.1,51.5-0.1c3.8,0,4.7,1.1,4.7,4.8c-0.1,34.5-0.1,69,0,103.5
                                                c0,3.6-0.7,4.9-4.6,4.8c-18.2-0.2-36.3-0.1-54.5-0.1c-2.4,0-4.4-0.5-6.3-2.2c-16.1-14.5-31.1-30.1-45.1-46.6c-1.7-2-2.6-4-2.6-6.7
                                                c0.1-17.7,0.2-35.3,0-53c0-3.5,1-4.5,4.5-4.5C1558.1,900.6,1575.6,900.6,1593.1,900.6z"/>
                                            <path class="st5 zone-svg" d="M789.8,1077.5c0,16.5-0.1,33,0.1,49.5c0,3.7-1.2,4.5-4.5,4.1c-35.9-4.4-71.1-11.9-105.6-23.1
                                                c-2.3-0.7-3-1.8-3-4.2c0.1-25.7,0.1-51.3,0-77c0-2.9,0.8-3.6,3.7-3.6c35.2,0.1,70.3,0.1,105.5,0c3.6,0,4,1.4,4,4.4
                                                C789.8,1044.1,789.8,1060.8,789.8,1077.5z"/>
                                            <path class="st5 zone-svg" d="M979.1,1023.2c17.3,0,34.7,0.1,52-0.1c3.5,0,4.5,0.9,4.5,4.4c-0.1,24-0.1,48,0,72c0,3.1-1.1,4.4-3.8,5.3
                                                c-34.4,11.8-69.6,20.1-105.6,25.1c-2.9,0.4-4.1-0.1-4.1-3.4c0.1-33.2,0.1-66.3,0-99.5c0-3.8,1.7-3.8,4.5-3.8
                                                C944.1,1023.2,961.6,1023.2,979.1,1023.2z"/>
                                            <path class="st10 zone-svg" d="M1715.6,768c-17.5,0-35-0.1-52.5,0.1c-3.2,0-4.3-0.8-4.2-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1.1-4.1,4.3-4.1
                                                c26.1,0.1,52.3,0.1,78.4,0c3.1,0,4.3,0.7,4.4,4.1c1.3,35.3,8.9,69.2,24.8,100.9c3,6,1.7,8.1-4.8,8.1
                                                C1749.3,768,1732.4,768,1715.6,768z"/>
                                            <path class="st2 zone-svg" d="M1526.7,711.9c0,17.2-0.1,34.3,0.1,51.5c0,3.7-1,4.8-4.8,4.7c-25.7-0.2-51.3-0.1-77,0c-3.3,0-4.5-0.9-5.2-4.2
                                                c-7.8-34.2-11.3-68.9-12.5-103.9c-0.1-3.9,1-5,5-5c29.8,0.2,59.6,0.2,89.5,0c3.9,0,5.1,1,5,5
                                                C1526.5,677.2,1526.7,694.5,1526.7,711.9z"/>
                                            <path class="st6 zone-svg" d="M1715.3,532.8c17.2,0,34.3,0.1,51.5-0.1c3.7,0,4.8,0.6,2.9,4.4c-15.9,32.7-23.8,67.2-23.7,103.6
                                                c0,3.4-1,4.6-4.5,4.6c-26-0.1-52-0.1-78,0c-3.4,0-4.6-0.9-4.6-4.5c0.1-34.5,0.1-69,0-103.4c0-3.9,1.3-4.7,4.9-4.7
                                                C1681,532.9,1698.1,532.8,1715.3,532.8z"/>
                                            <path class="st2 zone-svg" d="M2083.4,277c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.7-4.9-4.6c0.2-33.3,0.1-66.6,0-99.9
                                                c0-3.4,0.4-4.5,4.3-3.8c36.2,7,71.2,17.8,104.9,32.9c2.9,1.3,3.9,2.8,3.9,5.9c-0.1,21.5-0.2,43,0,64.5c0,4.4-1.5,5.1-5.4,5.1
                                                C2117.7,276.9,2100.5,277,2083.4,277z"/>
                                            <path class="st7 zone-svg" d="M1526.4,589.5c0,17.2-0.1,34.3,0.1,51.5c0,3.5-1,4.5-4.5,4.5c-30-0.1-60-0.1-90,0c-3.4,0-4.6-0.8-4.6-4.4
                                                c0.2-35.4,4.4-70.4,11.8-105c0.6-2.8,1.9-3.6,4.8-3.6c26,0.1,52,0.1,78,0c3.5,0,4.5,1.1,4.5,4.5
                                                C1526.4,554.5,1526.4,572,1526.4,589.5z"/>
                                            <path class="st2 zone-svg" d="M2206.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-4,0.1-5-1.2-4.9-5c0.1-34.3,0.2-68.7,0-103c0-4.3,1.3-4.9,5.3-5.2
                                                c10.5-0.8,19.6,2,28.7,7.4c24.6,14.6,49.7,28.4,74.7,42.3c3.1,1.7,4.5,3.6,4.4,7.3c-0.2,17.2-0.2,34.3,0,51.5c0,3.7-1,4.8-4.7,4.7
                                                C2241,890.8,2223.7,890.9,2206.3,890.9z"/>
                                            <path class="st2 zone-svg" d="M302.1,387.8c-1.3,14.1-1.3,14.1-15.2,10.9c-4.2-1-8.4-1.8-12.6-2.7c-32.5-7.7-65-15.6-97.5-22.9
                                                c-7.5-1.7-8.2-3.6-4.8-10.3c10.7-20.5,20.6-41.4,30.7-62.2c1.5-3.1,3-3.8,6.5-3c31,6.7,62.1,13.1,93.2,19.5
                                                c3.7,0.8,5.2,1.9,4.9,6.1C305.3,344.7,303.8,366.3,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M2083.5,1023.2c17.5,0,35,0.1,52.5-0.1c3.2,0,4.3,0.7,4.2,4.1c-0.2,19.3-0.1,38.7,0,58c0,2.4-0.5,3.8-3,4.9
                                                c-34.1,15.5-69.6,26.3-106.1,33.8c-3,0.6-4-0.1-4-3.4c0.1-31.2,0.1-62.3,0-93.5c0-3.7,1.5-3.9,4.5-3.9
                                                C2048.9,1023.2,2066.2,1023.2,2083.5,1023.2z"/>
                                            <path class="st5 zone-svg" d="M461.8,1006.1c-19.2-3-37.7-7.2-55.9-12.3c-14.5-4.1-28.7-9.3-43-14.3c-8.4-3-14.3-7.6-18.7-15.6
                                                c-7.2-13.3-7.7-13,5.4-21c26.5-16.2,53.1-32.3,79.6-48.6c3.1-1.9,4.4-1.7,6.4,1.5c17.9,29.7,36,59.4,54.2,89
                                                c1.7,2.8,1.9,4.3-1.2,6.1c-7.8,4.5-15.4,9.3-23,13.9C464.2,1005.5,463,1006.5,461.8,1006.1z"/>
                                            <path class="st9 zone-svg" d="M1224.3,400c-17.3,0-34.7-0.1-52,0.1c-3.9,0.1-4.6-1.1-4.6-4.7c0.1-34.7,0.1-69.3,0-104c0-3.3,0.5-4.9,4.3-4.5
                                                c3.3,0.3,6.7,0.6,10,0c15.8-2.8,27.1,3.8,37.8,15.1c17.6,18.7,34.7,37.7,50.6,57.9c7.8,9.9,12,19.9,10.9,32.7
                                                c-0.5,5.8-1.2,7.7-7.5,7.5C1257.3,399.6,1240.8,400,1224.3,400z"/>
                                            <path class="st2 zone-svg" d="M1035.4,834.6c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.8,4.9-4.7,4.9c-34.7-0.1-69.3-0.1-104,0
                                                c-3.2,0-4.8-0.5-4.7-4.3c0.2-12.3,0.2-24.7,0-37c0-2.8,0.9-4.1,3.4-5.2c33.2-13.3,60-34.8,81-63.6c1.7-2.3,3.5-3.2,6.2-3
                                                c7.3,0.3,16.9-2.4,21.3,1.3c4.5,3.8,1.2,13.7,1.3,21C1035.5,811.6,1035.4,823.1,1035.4,834.6z"/>
                                            <path class="st5 zone-svg" d="M572.9,208c-30.2,30.3-60,60.3-89.8,90.3c-4.2,4.3-8.5,8.4-12.7,12.7c-1.9,2-2.7,2.3-3.9-0.6
                                                c-10.4-25-20.9-49.9-31.5-74.8c-0.9-2.2-0.8-3.5,0.9-5.2c17-16.4,33.9-33,50.8-49.5c1.2-1.2,2.1-2.3,4.2-1.5
                                                C518.1,189,545.4,198.4,572.9,208z"/>
                                            <path class="st0 zone-svg" d="M987.8,1394.4c0-27.1,0.1-54.3-0.1-81.4c0-4,1.2-5,5-4.9c9.7,0.3,19.3,0.3,29,0c4.1-0.1,4.9,1.3,4.9,5.1
                                                c-0.1,43.1,0,86.3-0.2,129.4c0,4.8,1.4,5.6,5.8,5.6c21.6-0.2,43.3,0,65-0.2c3.7,0,5.2,0.6,5,4.7c-0.4,8-0.2,16,0,24
                                                c0.1,2.8-0.7,3.6-3.6,3.6c-35.6-0.1-71.3-0.1-106.9,0c-3.8,0-3.8-1.6-3.8-4.4C987.9,1448.7,987.8,1421.5,987.8,1394.4z"/>
                                            <path class="st2 zone-svg" d="M1167.9,956.9c0-17.2,0.1-34.3-0.1-51.5c0-3.7,0.7-5.2,4.9-5.2c34.5,0.1,69,0,103.4-0.2c3.9,0,4.8,1,5.1,4.9
                                                c0.5,7.4-1.7,13.3-6.1,19.3c-23.3,32.1-49.8,61.1-79.9,87c-2.6,2.2-5.3,2.5-8.3,2.4c-6.1-0.2-14.2,1.9-17.9-1.1
                                                c-3.9-3.2-1.1-11.6-1.2-17.7C1167.7,982.2,1167.9,969.6,1167.9,956.9z"/>
                                            <path class="st2 zone-svg" d="M676.9,834c0-17.2,0.1-34.3-0.1-51.5c0-3.7,1.1-4.4,4.7-4.8c11.2-1.2,18.8,2.1,26.2,11.7
                                                c20.2,26.3,46.8,44.6,77.9,56.3c3.1,1.2,4.4,2.4,4.4,5.9c-0.2,11.7-0.2,23.3,0,35c0,3.3-0.9,4.3-4.2,4.3
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-1-4.5-4.5C676.9,869,676.9,851.5,676.9,834z"/>
                                            <path class="st10 zone-svg" d="M979,409.9c17,0,34,0.2,50.9-0.1c4.5-0.1,5.5,1.4,5.5,5.6c-0.2,34-0.2,67.9,0,101.9c0,4.8-1.7,5.2-5.9,5.8
                                                c-12.3,1.7-19.8-3-27.2-13.3c-19.4-27-45.4-46.6-76.2-59.4c-3.2-1.3-4.2-2.9-4.1-6.2c0.2-10,0.2-20,0-30c-0.1-3.5,1.1-4.5,4.5-4.5
                                                C944.1,409.9,961.6,409.9,979,409.9z"/>
                                            <path class="st2 zone-svg" d="M2207,409.3c17,0,34,0.1,50.9-0.1c3.7,0,5.3,0.6,5.1,4.9c-0.3,11.5-0.2,23,0,34.5c0,2.9-0.9,4.5-3.4,5.9
                                                c-35.4,20.6-70.7,41.2-105.9,62c-3.8,2.3-3.8,0.6-3.8-2.5c0.1-33.3,0.1-66.6,0-99.9c0-3.7,0.9-4.8,4.7-4.8
                                                C2172.1,409.4,2189.6,409.3,2207,409.3z"/>
                                            <path class="st10 zone-svg" d="M1715.5,277c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.6-5.1-4.8c0.3-12.6,0.2-25.3,0.1-38
                                                c0-2.7,0.9-4.2,3.2-5.5c33.5-19.8,69-35.2,106.1-46.8c3.2-1,3.9-0.4,3.9,2.9c-0.1,29.3-0.1,58.6,0,87.9c0,3.8-1.5,4.2-4.7,4.2
                                                C1750.1,276.9,1732.8,277,1715.5,277z"/>
                                            <path class="st8 zone-svg" d="M686.8,404.3c34.4,3.7,69,7.4,103.6,11c3.8,0.4,5.4,1.3,4.7,5.6c-1.4,9.2-2.3,18.5-3,27.8
                                                c-0.2,2.7-1.5,3.3-3.6,3.8C748,462.3,715,484,688.2,515.8c-4.2,5-10.4,0.9-15.4,0.3c-3.4-0.4-1-4.2-0.8-6.3
                                                c3.5-33.9,7.2-67.8,10.9-101.8C683.1,405.5,683.1,403.1,686.8,404.3z"/>
                                            <path class="st6 zone-svg" d="M395.9,718.1c9.9-1,19.7-2.4,29.6-3c4.4-0.3,4.6-2,4.2-5.6c-1.4-11.5-2.4-23-3.6-34.5
                                                c19.7,1.7,39.4,3.4,59.1,4.9c2.9,0.2,4.1,1,4.1,4.1c-0.1,23.2-0.2,46.3-0.1,69.5c0,2.5-0.8,3.8-3.2,4.8
                                                c-29.5,12.7-59,25.5-88.4,38.4c-4,1.8-4.6,0.7-4.5-3.3C394.1,768.3,395,743.2,395.9,718.1z"/>
                                            <path class="st5 zone-svg" d="M1715.4,1023.2c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.8,4.2,4.1c-0.1,28-0.1,56,0,84c0,3.4-0.8,3.7-3.8,2.8
                                                c-37.2-11.2-72.7-26.5-106.4-46c-2.1-1.2-3-2.6-2.9-5.1c0.1-12,0.2-24,0-36c-0.1-3.2,1.1-3.8,4-3.8
                                                C1680.4,1023.2,1697.9,1023.2,1715.4,1023.2z"/>
                                            <path class="st5 zone-svg" d="M197.6,223.9c-31.5-3.8-62.8-7.6-94.2-11.4c-8.4-1-16.8-2.2-25.3-3c-3-0.3-3.4-1.4-2.7-4.1
                                                c1.5-6,2.9-12,3.9-18c0.8-4.9,3.2-8.4,6.8-11.7c18.7-17.3,41.7-27.9,63-41.1c1.4-0.9,2.9-0.7,4.3-0.5c9.2,1.5,18.4,3.2,27.6,4.4
                                                c3.3,0.4,4.3,2,4.9,4.9c4.7,25.7,9.5,51.3,14.4,77C200.7,222.9,201.1,224.8,197.6,223.9z"/>
                                            <path class="st8 zone-svg" d="M152,778.5c-27.5-0.8-54.7-3.7-81.7-9.2c-3.3-0.7-3.5-1.6-2.6-4.5c6.4-21.7,12.6-43.4,18.7-65.1
                                                c0.9-3.3,2.1-4.2,5.5-3.4c32.1,7.3,64.2,14.5,96.3,21.5c3.5,0.8,4.3,1.7,3.2,5.2c-5.1,17-9.9,34.1-14.7,51.2
                                                c-0.8,2.9-1.8,4.5-5.3,4.4C165,778.3,158.5,778.6,152,778.5z"/>
                                            <path class="st9 zone-svg" d="M1290.8,589c0-17.3,0.1-34.6-0.1-52c0-3.8,1-4.7,4.7-4.6c17,0.2,34,0.2,51,0c3,0,4.2,0.8,5,3.9
                                                c7.8,34.4,11.7,69.2,12.2,104.4c0.1,4.2-1.4,4.9-5.1,4.9c-20.8-0.2-41.6-0.2-62.5,0c-4,0-5.4-0.8-5.3-5.1
                                                C1291,623.3,1290.8,606.2,1290.8,589z"/>
                                            <path class="st10 zone-svg" d="M1290.9,711.2c0-17.1,0.1-34.3-0.1-51.4c0-3.5,0.6-4.9,4.6-4.9c21.1,0.2,42.3,0.2,63.4,0c3.5,0,4.5,1,4.4,4.5
                                                c-0.9,35.5-5.6,70.5-14.1,105c-0.7,2.9-2,3.6-4.8,3.6c-16.1-0.1-32.3-0.2-48.4,0c-3.9,0-5.1-0.9-5-4.9
                                                C1291,745.9,1290.9,728.5,1290.9,711.2z"/>
                                            <path class="st2 zone-svg" d="M1526.7,466.2c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.6,5.3-4.9,5.3c-24.8-0.2-49.7-0.2-74.5,0
                                                c-3.8,0-5-0.7-3.9-4.8c9.7-36.5,23.3-71.5,40.9-104.9c1.5-2.9,3.2-4.1,6.6-4c10.3,0.2,20.7,0.2,31,0c3.9-0.1,4.8,1.3,4.7,4.9
                                                C1526.6,431.5,1526.6,448.9,1526.7,466.2z"/>
                                            <path class="st5 zone-svg" d="M1781.8,778.8c14.8,21.8,32,38.9,53.2,51.8c17,10.2,35.2,17.3,54.7,20.4c4.1,0.7,5.3,2.2,5.2,6.3
                                                c-0.4,9.5-0.3,19,0,28.5c0.1,3.7-0.6,5.1-4.8,5.1c-34.6-0.2-69.3-0.1-103.9-0.1c-2.4,0-4.4,0.3-4.4-3.4
                                                C1781.9,851.8,1781.8,816.2,1781.8,778.8z"/>
                                            <path class="st5 zone-svg" d="M1526.5,834.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.8-4.8,4.7c-10.2-0.2-20.3-0.2-30.5,0
                                                c-2.7,0-4.1-0.9-5.4-3.2c-18.2-33.6-32-69-41.9-105.9c-1-3.6,0.1-4,3.3-4c25,0.1,50,0.1,75,0c3.7,0,4.3,1.1,4.3,4.5
                                                C1526.4,799.6,1526.5,816.9,1526.5,834.3z"/>
                                            <path class="st3 zone-svg" d="M155.7,664c-0.9-0.9-1.7-1.8-2.4-2.6c-20.5-22.5-35.2-48.7-49.4-75.3c-1.1-2.1-0.7-3.2,1-4.6
                                                c14.4-12.3,28.8-24.7,43.1-37.2c2.2-1.9,3.3-1.1,4.8,0.6c19.5,22.3,39.1,44.5,58.7,66.8c1.7,1.9,1.9,2.9-0.2,4.7
                                                c-17.9,15.2-35.6,30.6-53.4,45.9C157.2,662.9,156.6,663.3,155.7,664z"/>
                                            <path class="st2 zone-svg" d="M1781.9,515.8c0-2.9,0-4.1,0-5.4c0-32,0.1-63.9-0.1-95.9c0-4.2,1.2-5.3,5.3-5.2c34.1,0.2,68.3,0.2,102.4,0
                                                c4.5,0,5.7,1.3,5.5,5.7c-0.3,7.8-0.2,15.6-0.1,23.5c0,2.4-0.6,3.5-3.1,4C1845.2,450.7,1809.5,475.7,1781.9,515.8z"/>
                                            <path class="st5 zone-svg" d="M1101.2,277c-17.5,0-35-0.1-52.5,0.1c-3.1,0-3.9-0.8-3.8-3.9c0.1-25.5,0.1-51,0-76.5c0-3.1,0.3-4.1,3.7-2.8
                                                c37.9,14.5,73.7,33,107.1,56c1.9,1.3,2.5,2.8,2.4,4.9c-0.2,7.2,2.6,16.6-1,20.8c-3.6,4.4-13.4,1.1-20.5,1.2
                                                C1124.9,277.2,1113.1,277,1101.2,277z"/>
                                            <path class="st3 zone-svg" d="M610.8,1023.2c17.1,0,34.3,0.1,51.4-0.1c3.5,0,4.9,0.6,4.9,4.5c-0.2,23.8-0.2,47.6,0,71.4
                                                c0,4.2-1.2,4.1-4.5,2.9c-36.4-13.5-71-30.8-103.6-51.9c-3.8-2.4-5.2-5-5.2-9.5c0.3-17.3,0.1-17.3,17.5-17.3
                                                C584.5,1023.2,597.7,1023.2,610.8,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1101.7,1023.1c17.3,0,34.6,0.1,52-0.1c3.5,0,4.2,1,4.6,4.4c1.2,9.2-2.3,14.5-10.2,19.6
                                                c-30.9,20-63.2,36.9-97.3,50.6c-4.5,1.8-5.9,1.5-5.8-3.9c0.3-21.8,0.2-43.6,0-65.5c0-4,0.9-5.4,5.2-5.4
                                                C1067.4,1023.3,1084.5,1023.1,1101.7,1023.1z"/>
                                            <path class="st3 zone-svg" d="M2017.6,827.8c0,20.6,0,40.2,0,59.8c0,2.8-1.3,3.2-3.7,3.2c-35.3-0.1-70.6-0.1-105.9,0c-3,0-3.7-1.1-3.6-3.8
                                                c0.1-10.2,0.1-20.3,0-30.5c0-2.4,0.5-3.6,3.4-3.4C1946.6,856,1983.2,848.7,2017.6,827.8z"/>
                                            <path class="st5 zone-svg" d="M357.8,886.7c-37.7-2.9-74.9-10.3-111.3-22.2c-3.7-1.2-4.3-2.2-1.9-5.5c10.2-14.6,20.2-29.3,30-44.1
                                                c2-3.1,3.3-2.9,6.1-1c28.8,19.7,57.7,39.3,86.7,58.8c2.8,1.9,3.4,3.3,0.9,5.7C365.1,881.4,365.1,888.2,357.8,886.7z"/>
                                            <path class="st3 zone-svg" d="M1290.8,466.1c0-16.7-0.1-33.3,0.1-50c0-2-2-5.9,1.9-6c4-0.1,8.7-2.5,11.8,3.2c17.5,32.1,31.3,65.7,41.2,100.9
                                                c2.4,8.7,2.4,8.7-6.6,8.7c-14.3,0-28.7-0.2-43,0.1c-4.3,0.1-5.7-0.8-5.6-5.4C1291,500.4,1290.8,483.2,1290.8,466.1z"/>
                                            <path class="st5 zone-svg" d="M1961.3,409.5c17,0,34,0.1,50.9-0.1c4-0.1,5.4,0.8,5.4,5.1c-0.3,16-0.2,32-0.1,47.9c0,3.3-0.5,4.2-3.7,2.2
                                                c-32.1-19.9-67.4-26.4-104.6-24.4c-3.8,0.2-4.9-0.5-4.8-4.4c0.3-7.1,0.3-14.3,0-21.5c-0.2-3.9,0.9-5.1,4.9-5
                                                C1926.7,409.6,1944,409.5,1961.3,409.5z"/>
                                            <path class="st10 zone-svg" d="M2272.9,298.6c17.6,18.5,32.8,37.2,46.6,57.1c9,12.9,17.2,26.1,25.1,39.6c1.9,3.3,2.6,4.8-2.5,4.7
                                                c-21.7-0.2-43.3-0.1-65-0.1c-2.1,0-4.3,0.5-4.3-3C2272.9,364.7,2272.9,332.4,2272.9,298.6z"/>
                                            <path class="st3 zone-svg" d="M856,890.8c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.3-0.7-5.2-4.9c0.3-10.5,0.2-21,0.1-31.5c0-3.1,0.6-4.1,4-3.2
                                                c35.1,9.1,70.1,8.9,105-1c3.5-1,4.3-0.1,4.3,3.3c-0.2,11-0.2,22,0,33c0.1,3.7-1.4,4.3-4.7,4.3C890.6,890.8,873.3,890.8,856,890.8z"
                                                />
                                            <path class="st8 zone-svg" d="M2250.8,277c-33.5,0-65.6,0-97.6,0c-2.3,0-3.2-0.6-3.2-3c0.1-20.8,0.1-41.6,0-62.4c0-2.8,0.8-3,3.1-1.8
                                                C2188.4,227.5,2220.5,249.6,2250.8,277z"/>
                                            <path class="st5 zone-svg" d="M1290.8,835c0-17.5,0.1-35-0.1-52.5c0-3.5,0.5-4.9,4.5-4.8c15.1,0.3,30.3,0.2,45.5,0c3.4,0,4.6,0.2,3.4,4.2
                                                c-11.1,37.6-26.7,73.3-46.4,107.1c-1.2,2.1-2.5,4.1-5.3,3.3c-3-0.8-1.5-3.4-1.5-5C1290.8,869.9,1290.8,852.5,1290.8,835z"/>
                                            <path class="st5 zone-svg" d="M2272.8,993.2c0-9.6,0-18.7,0-27.7c0-20.3,0.1-40.6-0.1-60.9c0-3.5,0.9-4.5,4.4-4.4c21,0.2,41.9,0.1,62.9,0.1
                                                c2.6,0,4.8-0.5,2.4,3.4c-19.7,31.7-42.1,61.4-67.9,88.5C2274.3,992.3,2273.8,992.5,2272.8,993.2z"/>
                                            <path class="st6 zone-svg" d="M856.1,409.9c17,0,34,0.1,50.9-0.1c4.2-0.1,5.4,1.3,5.3,5.4c-0.3,8.6-0.2,17.3,0,26c0.1,3.4-0.9,3.8-4,2.9
                                                c-34.4-10.1-69-10.9-103.9-2.6c-3.7,0.9-4.8,0.2-4.7-3.6c0.2-7.7,0.2-15.3,0-23c-0.1-3.9,1-5.2,5-5.1
                                                C821.8,410,839,409.9,856.1,409.9z"/>
                                            <path class="st1 zone-svg" d="M2241.8,1023.2c-28.1,24.1-57.3,43.6-89,59.5c-2.7,1.4-2.9,0.3-2.9-2.1c0.1-18,0-35.9,0-53.9
                                                c0-1.9-0.2-3.6,2.7-3.5C2181.9,1023.2,2211.1,1023.2,2241.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M2335.4,409.5c-1.6,1.3-2.2,1.9-3,2.3c-18.6,10.9-37.3,21.8-55.9,32.8c-3,1.8-3.8,1.6-3.7-2
                                                c0.2-9.8,0.2-19.6,0-29.5c0-2.9,0.9-3.7,3.7-3.6C2295.6,409.5,2314.8,409.5,2335.4,409.5z"/>
                                            <path class="st5 zone-svg" d="M481.9,80.8c19.4-8.7,38.5-15.6,57.6-22.4c2.9-1,2.7,0.5,2.3,2.4c-2.2,11.2-4.4,22.4-6.5,33.7
                                                c-0.4,1.9-0.7,3.2-3,2.4C515.7,91.6,499.2,86.3,481.9,80.8z"/>
                                            <path class="st5 zone-svg" d="M2108.5,768c-9.1,0-18.3-0.1-27.4,0c-2.8,0-3.6-0.3-1.8-3.1c5.5-8.5,10.9-17.1,16-25.8c1.5-2.6,2.7-2.5,5-1.2
                                                c12.4,7.1,24.8,14.2,37.3,21c3.5,1.9,2.7,4.6,2.6,7.2c-0.2,3.4-3.1,1.7-4.7,1.7C2126.4,768.1,2117.5,768,2108.5,768z"/>
                                            <path class="st5 zone-svg" d="M1594.5,277c17.8-15,35.3-28.1,54.6-40.2c0,13.1,0,25.5,0,37.9c0,1.7-0.5,2.4-2.3,2.4
                                                C1629.9,277,1612.8,277,1594.5,277z"/>
                                            <path class="st5 zone-svg" d="M1526.5,348.4c0,18.2,0,34.6,0,51c0,2.1-1.2,2.4-2.9,2.4c-9.7,0-19.3-0.1-29,0c-2.5,0-3.4-0.4-1.9-3
                                                C1502.6,381.8,1513.4,365.5,1526.5,348.4z"/>
                                            <path class="st2 zone-svg" d="M1597.8,1023.1c16.8,0,32.1,0.1,47.4-0.1c3.1,0,4,1,4,4c-0.2,9.8-0.1,19.6-0.1,29.5c0,2,0.2,3.9-2.8,2
                                                C1629.8,1048,1614,1036.5,1597.8,1023.1z"/>
                                            <path class="st2 zone-svg" d="M1526.7,949.9c-12.4-15.9-22.4-31.1-31.8-46.8c-1.3-2.2-0.6-2.9,1.8-2.9c9,0,18,0,26.9,0c2,0,3.1,0.6,3.1,2.8
                                                C1526.6,918,1526.7,933,1526.7,949.9z"/>
                                            <path class="st5 zone-svg" d="M2126.3,532.5c-12.3,7.2-23.1,13.3-33.7,19.8c-2.7,1.6-3.1-0.2-4-1.7c-2.8-4.9-5.4-9.9-8.4-14.7
                                                c-2.1-3.3-0.5-3.4,2.2-3.4C2096.4,532.5,2110.4,532.5,2126.3,532.5z"/>
                                            <path class="st2 zone-svg" d="M311,211c-7,9.8-16.7,17.1-24.6,26c-1.3,1.5-2.4,0.6-3.4-0.2c-5.9-4.3-11.8-8.7-18.7-13.7
                                                C280.5,218.7,295.4,213.6,311,211L311,211z"/>
                                            <path class="st3 zone-svg" d="M1035.6,727.4c0,12.4,0,24.9,0,37.3c0,1.1,0.4,2.9-1,3c-6,0.2-12,0.3-17.9,0c-1.3-0.1-0.4-1.6,0.1-2.3
                                                C1023.9,753.2,1029.9,740.5,1035.6,727.4z"/>
                                            <path class="st2 zone-svg" d="M284,961c-13.5-6.9-25.7-15.8-39.5-24.1c10.6,0,20.1,0,29.6,0c1.2,0,1.9,0.6,2.2,1.6
                                                C278.8,946.1,282.8,953.1,284,961L284,961z"/>
                                            <path class="st5 zone-svg" d="M1035.5,568.6c-5.2-11.4-10-22.8-16.2-33.6c-1.2-2.1-0.4-2.6,1.7-2.5c0.2,0,0.3,0,0.5,0
                                                c14.1-0.8,14.1-0.8,14.1,13.2C1035.5,553.3,1035.5,560.9,1035.5,568.6z"/>
                                            <path class="st3 zone-svg" d="M1191.4,277c-3.9,0-6.2,0-8.5,0c-17,0-17,0-14.6-18.1c3.9,3,7.6,5.7,11.2,8.5
                                                C1183.2,270.3,1186.7,273.2,1191.4,277z"/>
                                            <path class="st5 zone-svg" d="M676.8,740.8c4.8,8.9,9,16.6,13.1,24.3c0.4,0.7,0.9,2.1,0.9,2.1c-3.7,1.7-7.7,0.3-11.5,0.8
                                                c-2,0.2-2.5-0.8-2.5-2.6C676.9,757.6,676.8,749.8,676.8,740.8z"/>
                                            <path class="st5 zone-svg" d="M522,1023.2c7.6,0,13.6,0.1,19.5,0c3.8-0.1,2.7,2.6,2.7,4.5c0,3.7-0.3,7.5-0.5,11.2c-3.8-1.1-6.3-4-9.3-6.2
                                                C530.5,1030,527,1027,522,1023.2z"/>
                                            <path class="st5 zone-svg" d="M676.8,551.5c0-6.4,0.1-11,0-15.6c-0.1-2.5,0.5-3.8,3.3-3.4c1.9,0.3,3.8,0.4,5.7,0.6c-0.7,1.6-1.4,3.2-2.2,4.8
                                                C681.5,542,679.5,546.1,676.8,551.5z"/>
                                            <path class="st5 zone-svg" d="M1180.8,1023.2c-4.5,3.4-7.7,5.9-10.9,8.2c-0.4,0.3-1.2,0.2-1.8,0.3c-0.1-2.1-0.2-4.3-0.2-6.4
                                                c-0.1-1.4,0.5-2.1,2-2.1C1173,1023.2,1176,1023.2,1180.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M1290.8,390c2.2,3.6,3.7,6,5,8.4c0.5,0.9,0.6,2.1,0.9,3.2c-1.3,0.1-2.6,0.1-4,0.2c-1.5,0.1-2-0.7-2-2.1
                                                C1290.9,397,1290.8,394.2,1290.8,390z"/>
                                            <path class="st5 zone-svg" d="M2017.2,166.1c-3.7-0.6-7.4-1.3-11.1-1.9C2009.8,164.8,2014.1,161.8,2017.2,166.1z"/>
                                            <path class="st2 zone-svg" d="M311,211c0.1-0.2,0.3-0.3,0.4-0.5c0,0.1,0,0.3-0.1,0.3C311.3,210.9,311.1,210.9,311,211
                                                C311,211,311,211,311,211z"/>
                                            <path class="st2 zone-svg" d="M284,961c0.2,0.1,0.3,0.2,0.5,0.3c-0.1,0-0.2,0-0.3,0C284.1,961.2,284.1,961.1,284,961
                                                C284,961,284,961,284,961z"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li><li class='col-2 transfered'>
                                    <a href='#'>
                                        <span class='content-transfered captain-train-trainline'>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401.99 113.69"><path class="ct-1 zone-svg" d="M184.58,36c-1.35,7.95-7.22,14.14-17.27,14.14-11.18,0-19.31-7.48-19.31-18.81s8.13-18.81,19.31-18.81c10,0,15.87,6.21,17.26,14.06l-9.45,2.18c-0.8-4.82-3.38-7.39-7.72-7.39-4.51,0-7.65,3.13-7.65,10s3.14,10,7.65,10c4.34,0,6.92-2.65,7.72-7.48,0,0,9.47,2.17,9.47,2.18m26.57-2.66-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,220.25,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0Zm55.75-17.84h-5V14.55l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16V13.5h9.5v8.12h-9.5V36.49c0,3.05,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45V47c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0ZM326,33.36l-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,335.05,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0ZM243.5,31.75c0,5.79,3.3,9.4,8.13,9.4,5.47,0,8.13-3.94,8.13-9.81s-2.65-9.73-8.13-9.73c-4.83,0-8.13,3.62-8.13,9.32v0.8h0Zm0,31H231.91V13.5H243.5v6.43c1.77-4.26,5.87-7.4,12.07-7.4,10.46,0,15.93,8.36,15.93,18.81S266,50.15,255.57,50.15c-6.2,0-10.3-3.13-12.07-7.32v20h0ZM262.93,112H251.34V76.36h11.59V112h0ZM251.35,66.3l11.55-3.45V73.46H251.35V66.3ZM377.45,49.19H365.86V13.5h11.59V19c1.93-3.94,6.28-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V49.19H390.4V29.66c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V49.19h0ZM153,84.48h-5V77.4l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16v9.89h9.5v8.12h-9.5V99.34c0,3.06,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45v7.64c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0Zm52.38,3.22a11.48,11.48,0,0,0-6.11-1.45c-4.83,0-8,2.73-8,8.92V112H179.61V76.36H191.2v6.51a10.68,10.68,0,0,1,9.9-7.48,8.19,8.19,0,0,1,5,1.45Zm25.26,8.52-5.87,1.2c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.11,3.38,4.26,0,7.64-3.21,7.64-8.28V96.21h0Zm11.43,6.11c0,1.85.8,2.65,2.25,2.65a6.63,6.63,0,0,0,3-.64v6.19a12.09,12.09,0,0,1-7.57,2.33c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.66-3.62-11.66-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V89.46c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.06l-10.78-.8C210.11,80.7,215.82,75.4,226,75.4c9.33,0,16,4.18,16,13.91v13h0ZM282.11,112H270.53V76.36h11.59V81.9c1.93-3.94,6.27-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V112H295.07V92.51c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V112h0ZM358.3,49.19H346.71V13.5H358.3V49.19h0ZM346.73,3.44L358.28,0V10.6H346.73V3.44h0Z" transform="translate(0 0.01)"/><path class="ct-2 zone-svg" d="M99,77.23l10.42-10.41L46.9,4.36,36.48,14.77ZM62.49,113.66L72.9,103.24,10.42,40.78,0,51.2Z" transform="translate(0 0.01)"/><path class="ct-3 zone-svg" d="M80.68,95.49L91.1,85.08,28.59,22.6,18.17,33Z" transform="translate(0 0.01)"/><path class="ct-4 zone-svg" d="M36.44,103.26l10.42,10.41,62.49-62.46L98.93,40.81ZM0,66.8L10.42,77.21,72.91,14.75,62.49,4.34Z" transform="translate(0 0.01)"/></svg>
                                            <span>
                                                Acquired by
                                            </span>
                                            <span>
                                                <svg id="trainline-color.svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 84"><path class="tl-1 zone-svg" d="M254.33,69.79a21.67,21.67,0,0,1-2.58.11c-3.7,0-6.39-1.34-6.39-6.15V1.34H230.66V66.21c0,10.63,6.73,16.89,17.49,16.89a27.45,27.45,0,0,0,6.17-.67V69.79h0Zm49.12-19.13c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1h14.91V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H288.53v55h14.92V50.67h0Zm-117.86,0c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1H221V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H170.67v55h14.91V50.67h0ZM260.83,9.28a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H262.62v55h14.91v-55h0Zm-134.68-18a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H144.65v55h14.92v-55h0Zm228.2,35.57c-1.79,4.92-5.61,8.39-12.56,8.39-7.4,0-13.57-5.26-13.91-12.53h39.47c0-.22.22-2.46,0.22-4.59,0-17.67-10.2-28.52-27.25-28.52-14.13,0-27.14,11.41-27.14,29C346.62,73.15,360,84,375.1,84c13.57,0,22.32-7.94,25.12-17.45ZM361.64,48.54A11.93,11.93,0,0,1,374,37.69c8.52,0,12.11,5.37,12.33,10.85H361.64ZM106.75,72.81c-4.82,0-7.18-3.13-7.18-6.38,0-4.25,3-6.37,6.84-6.93l12.45-1.9v2.46c0,9.73-5.83,12.75-12.11,12.75M84.66,67.33c0,8.61,7.18,16.55,19,16.55,8.19,0,13.46-3.8,16.26-8.16a37.1,37.1,0,0,0,.56,6.6h13.68a61.5,61.5,0,0,1-.67-8.72V46.53c0-11.07-6.5-20.91-24-20.91-14.8,0-22.76,9.51-23.66,18.12L99,46.53c0.45-4.81,4-8.95,10.54-8.95,6.28,0,9.31,3.24,9.31,7.16,0,1.9-1,3.47-4.15,3.92l-13.57,2C91.95,52,84.66,57.49,84.66,67.34M79.05,27.07a34,34,0,0,0-3.48-.22c-4.71,0-12.34,1.34-15.7,8.61V27.3H45.42v55H60.33V57.15c0-11.85,6.62-15.55,14.24-15.55a22.48,22.48,0,0,1,4.49.45v-15h0ZM10,43.73V66.1c0,10.63,6.73,17,17.49,17a21.81,21.81,0,0,0,8.41-1.34V69.46a21.68,21.68,0,0,1-4.6.45c-4.26,0-6.5-1.57-6.5-6.38V43.73H10ZM24.56,24a12.75,12.75,0,0,0,.22-3V10.85H11.33v7.6A9.43,9.43,0,0,1,9.87,24H24.56ZM0,27.29v13.2H5.61c10,0,16-5.26,18.39-13.2H0Zm27.25,0a20.22,20.22,0,0,1-9.08,13.2H35.88V27.29H27.25Z" transform="translate(0 0)"/></path></svg>
                                            </span>
                                        </span>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/stripe.png' alt='Stripe' class='no-scroll'>-->
                                        <svg class='svg-akeneo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 338.22 73.37"><defs><linearGradient id="Dégradé_sans_nom" x1="313.56" y1="-514.57" x2="382.56" y2="-514.57" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="0.97" stop-color="#9452ba"/></linearGradient><linearGradient id="Dégradé_sans_nom_2" x1="367.19" y1="-548.12" x2="367.19" y2="-482.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="1" stop-color="#fff"/></linearGradient><linearGradient id="Dégradé_sans_nom_3" x1="332.8" y1="-548.12" x2="332.8" y2="-482.12" xlink:href="#Dégradé_sans_nom_2"/><linearGradient id="Dégradé_sans_nom_4" x1="332.78" y1="-493.12" x2="332.78" y2="-545.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.23" stop-color="#4f1374"/><stop offset="0.84" stop-color="#5f2385"/></linearGradient><linearGradient id="Dégradé_sans_nom_5" x1="367.23" y1="-493.12" x2="367.23" y2="-545.12" xlink:href="#Dégradé_sans_nom_4"/></defs><path d="M109.73,38.8q0-4.68-2.38-6.5t-6.9-1.82a29.27,29.27,0,0,0-5.19.44,39.38,39.38,0,0,0-4.72,1.15A12.35,12.35,0,0,1,89,25.8a36.47,36.47,0,0,1,6-1.35,43.34,43.34,0,0,1,6.26-.48q7.93,0,12,3.61t4.12,11.54V64.57q-2.78.64-6.74,1.31a48.17,48.17,0,0,1-8.09.67,31.62,31.62,0,0,1-7-.71,14.32,14.32,0,0,1-5.31-2.3,10.66,10.66,0,0,1-3.37-4,13.55,13.55,0,0,1-1.19-6,12.12,12.12,0,0,1,5.15-10.27,16.81,16.81,0,0,1,5.47-2.54,24.87,24.87,0,0,1,6.5-.83q2.54,0,4.16.12t2.73,0.28V38.8h0Zm0,7.69q-1.19-.16-3-0.32T103.64,46q-4.92,0-7.49,1.82a6.34,6.34,0,0,0-2.58,5.55,6.82,6.82,0,0,0,.87,3.73,6,6,0,0,0,2.18,2.06,7.58,7.58,0,0,0,2.89.87,30,30,0,0,0,3,.16,36.68,36.68,0,0,0,3.77-.2,22.5,22.5,0,0,0,3.45-.59V46.49h0Z" transform="translate(0.38 -0.21)"/><path d="M128.92,7.48a18.66,18.66,0,0,1,1.94-.24c0.71,0,1.36-.08,1.94-0.08a18.29,18.29,0,0,1,2,.08,18.65,18.65,0,0,1,2,.24V65.6a18.62,18.62,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V7.48Zm8,37L151.84,24.9q1-.16,2.06-0.24t2.14-.08q1.19,0,2.26.08t2.18,0.24l-14.92,19L162.7,65.54q-1.11.16-2.14,0.24t-2.14.08q-1.11,0-2.22-.08L154,65.6Z" transform="translate(0.38 -0.21)"/><path d="M174.27,47.2q0.16,6.66,3.45,9.75T187.43,60a29.13,29.13,0,0,0,10.7-2,11.89,11.89,0,0,1,1,2.89,18.85,18.85,0,0,1,.48,3.37A26.52,26.52,0,0,1,193.86,66a40,40,0,0,1-6.94.55A26.2,26.2,0,0,1,177.41,65,16.72,16.72,0,0,1,167.1,54a28.46,28.46,0,0,1-1.19-8.44,29.9,29.9,0,0,1,1.15-8.44,19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.76,19.76,0,0,1,185.11,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6,24.35,24.35,0,0,1,1.11,7.49q0,1.11-.08,2.34t-0.16,2.1H174.27Zm20.14-5.87a15,15,0,0,0-.59-4.24,10.8,10.8,0,0,0-1.74-3.53,8.51,8.51,0,0,0-2.93-2.42,9.22,9.22,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M212.48,24.92q0.87-.16,1.7-0.24c0.56,0,1.12-.08,1.71-0.08a15.6,15.6,0,0,1,1.63.08q0.75,0.08,1.62.24,0.24,1.19.48,3.21a29.87,29.87,0,0,1,.24,3.37,16.26,16.26,0,0,1,2-2.7,15.57,15.57,0,0,1,2.81-2.42A14.52,14.52,0,0,1,232.84,24q7,0,10.31,4t3.33,11.85V65.6a18.66,18.66,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V42q0-5.63-1.75-8.29A6.16,6.16,0,0,0,231.3,31a11.19,11.19,0,0,0-4.2.79,9.33,9.33,0,0,0-3.49,2.46,12.3,12.3,0,0,0-2.42,4.32,19.71,19.71,0,0,0-.91,6.38V65.6a18.65,18.65,0,0,1-1.94.24q-1.07.08-1.94,0.08t-2-.08a18.57,18.57,0,0,1-2-.24V24.92h0.08Z" transform="translate(0.38 -0.21)"/><path d="M264.17,47.2q0.16,6.66,3.45,9.75T277.33,60A29.14,29.14,0,0,0,288,58a12,12,0,0,1,1,2.89,19,19,0,0,1,.47,3.37,26.52,26.52,0,0,1-5.7,1.7,40,40,0,0,1-6.94.55A26.19,26.19,0,0,1,267.35,65,16.72,16.72,0,0,1,257,54a28.47,28.47,0,0,1-1.19-8.44A29.94,29.94,0,0,1,257,37.12a19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.77,19.77,0,0,1,275,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6A24.32,24.32,0,0,1,292,42.79q0,1.11-.08,2.34t-0.16,2.1H264.17v0Zm20.14-5.87a15,15,0,0,0-.59-4.24A10.82,10.82,0,0,0,282,33.56,8.51,8.51,0,0,0,279,31.14a9.21,9.21,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M318.88,66.55a19.91,19.91,0,0,1-8.32-1.62,16.55,16.55,0,0,1-6-4.48,18.61,18.61,0,0,1-3.53-6.74,31.27,31.27,0,0,1,0-16.81,18.63,18.63,0,0,1,3.53-6.74,17,17,0,0,1,6-4.52,21.64,21.64,0,0,1,16.65,0,16.94,16.94,0,0,1,6,4.52,18.66,18.66,0,0,1,3.53,6.74,31.27,31.27,0,0,1,0,16.81,18.65,18.65,0,0,1-3.53,6.74,16.53,16.53,0,0,1-6,4.48A19.92,19.92,0,0,1,318.88,66.55Zm0-6.26q5.47,0,8.09-4t2.62-11q0-7-2.62-11t-8.09-3.92q-5.47,0-8,3.92t-2.58,11q0,7.06,2.58,11t8,4h0Z" transform="translate(0.38 -0.21)"/><path class="ak-1 zone-svg" d="M55.28,71.89c0.27,0.88.51,1.49,0.58,1.69h0c-1.34-19.17,9.75-26.76,13.65-39.33a4.37,4.37,0,0,1,.13-0.62,8.27,8.27,0,0,0,.2-0.86c0.64-3.49-.67-7.63-3.25-12V20.7c-0.21-.36-0.44-0.72-0.67-1.09h0c-0.43-.66-0.88-1.33-1.36-2l-0.15-.21L64,16.85l-0.42-.56-0.43-.55-0.45-.57-0.32-.4A96.15,96.15,0,0,0,47.19.21h0a94.09,94.09,0,0,1-.49,20.13,76,76,0,0,1-7.48,22.08,76,76,0,0,1-22.52-6A92.68,92.68,0,0,1-.3,25.64c0,0.6.1,1.19,0.15,1.79A1.91,1.91,0,0,0-.1,28,11.1,11.1,0,0,0,0,29.24a1.71,1.71,0,0,0,.07.59,10.91,10.91,0,0,0,.15,1.28,1.54,1.54,0,0,0,.06.52c0.07,0.54.14,1.08,0.22,1.61a1.31,1.31,0,0,0,0,.16C0.62,34,.72,34.64.82,35.25v0.14C0.91,35.94,1,36.49,1.11,37l0.06,0.33c0.09,0.5.19,1,.29,1.49a0.52,0.52,0,0,0,.06.29c0.12,0.57.24,1.14,0.37,1.7h0q0.63,2.71,1.39,5.23a0.43,0.43,0,0,1,0,.06,50.57,50.57,0,0,0,3,7.67l0.51,1h0c0.15,0.29.31,0.57,0.47,0.85h0c0.17,0.3.35,0.59,0.53,0.87h0l0.08,0.11h0c0.23,0.36.48,0.71,0.71,1L8.71,57.8v0.06c0.28,0.38.56,0.74,0.86,1.08h0c0.2,0.24.41,0.47,0.62,0.69l0.27,0.27,0.4,0.39,0.31,0.27,0.39,0.33,0.32,0.24,0.41,0.3,0.32,0.21L13,61.91l0.3,0.17,0.51,0.25,0.25,0.12a7.57,7.57,0,0,0,.78.29l0.47,0.18C28,66.71,40.58,61.79,55.78,73.45" transform="translate(0.38 -0.21)"/><path class="ak-2 zone-svg" d="M46.68,20.35A76,76,0,0,1,39.2,42.43c14.25,1.66,28.07-.51,30.45-8.81,2.6-9.06-9.17-23-22.48-33.4A92.76,92.76,0,0,1,46.68,20.35Z" transform="translate(0.38 -0.21)"/><path class="ak-3 zone-svg" d="M16.68,36.41a92.68,92.68,0,0,1-17-10.78C0.9,42.47,6,60,15,62.87c8.22,2.63,17.7-7.67,24.23-20.44A76,76,0,0,1,16.68,36.41Z" transform="translate(0.38 -0.21)"/><path class="ak-4 zone-svg" d="M28,52.37A51.23,51.23,0,0,1-.38,25.63h0c0.77,10.32,3,20.89,6.65,28.2,0.16,0.31.32,0.63,0.49,0.93v0.08q0.24,0.44.48,0.85L7.31,55.8q0.24,0.41.48,0.79L7.87,56.7l0.5,0.76,0.34,0.46L8.79,58,9,58.34c0.19,0.25.39,0.49,0.58,0.72a11.87,11.87,0,0,0,5.31,3.8L15.39,63C28,66.83,40.61,61.91,55.81,73.57,54.7,72,43.9,58.27,28,52.37Z" transform="translate(0.38 -0.21)"/><path class="ak-5 zone-svg" d="M69.65,33.62c2.6-9.06-9.18-23-22.48-33.4h0a51.39,51.39,0,0,1,6.44,38.45c-4,16.8,1.8,33.63,2.25,34.9h0C54.52,54.4,65.61,46.81,69.51,34.24A4.37,4.37,0,0,1,69.65,33.62Z" transform="translate(0.38 -0.21)"/></svg>
                                    </a>
                                </li><li class='col-2 transfered'>
                                    <a href='#'>
                                        <span class='content-transfered captain-train-trainline'>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401.99 113.69"><path class="ct-1 zone-svg" d="M184.58,36c-1.35,7.95-7.22,14.14-17.27,14.14-11.18,0-19.31-7.48-19.31-18.81s8.13-18.81,19.31-18.81c10,0,15.87,6.21,17.26,14.06l-9.45,2.18c-0.8-4.82-3.38-7.39-7.72-7.39-4.51,0-7.65,3.13-7.65,10s3.14,10,7.65,10c4.34,0,6.92-2.65,7.72-7.48,0,0,9.47,2.17,9.47,2.18m26.57-2.66-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,220.25,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0Zm55.75-17.84h-5V14.55l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16V13.5h9.5v8.12h-9.5V36.49c0,3.05,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45V47c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0ZM326,33.36l-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,335.05,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0ZM243.5,31.75c0,5.79,3.3,9.4,8.13,9.4,5.47,0,8.13-3.94,8.13-9.81s-2.65-9.73-8.13-9.73c-4.83,0-8.13,3.62-8.13,9.32v0.8h0Zm0,31H231.91V13.5H243.5v6.43c1.77-4.26,5.87-7.4,12.07-7.4,10.46,0,15.93,8.36,15.93,18.81S266,50.15,255.57,50.15c-6.2,0-10.3-3.13-12.07-7.32v20h0ZM262.93,112H251.34V76.36h11.59V112h0ZM251.35,66.3l11.55-3.45V73.46H251.35V66.3ZM377.45,49.19H365.86V13.5h11.59V19c1.93-3.94,6.28-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V49.19H390.4V29.66c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V49.19h0ZM153,84.48h-5V77.4l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16v9.89h9.5v8.12h-9.5V99.34c0,3.06,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45v7.64c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0Zm52.38,3.22a11.48,11.48,0,0,0-6.11-1.45c-4.83,0-8,2.73-8,8.92V112H179.61V76.36H191.2v6.51a10.68,10.68,0,0,1,9.9-7.48,8.19,8.19,0,0,1,5,1.45Zm25.26,8.52-5.87,1.2c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.11,3.38,4.26,0,7.64-3.21,7.64-8.28V96.21h0Zm11.43,6.11c0,1.85.8,2.65,2.25,2.65a6.63,6.63,0,0,0,3-.64v6.19a12.09,12.09,0,0,1-7.57,2.33c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.66-3.62-11.66-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V89.46c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.06l-10.78-.8C210.11,80.7,215.82,75.4,226,75.4c9.33,0,16,4.18,16,13.91v13h0ZM282.11,112H270.53V76.36h11.59V81.9c1.93-3.94,6.27-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V112H295.07V92.51c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V112h0ZM358.3,49.19H346.71V13.5H358.3V49.19h0ZM346.73,3.44L358.28,0V10.6H346.73V3.44h0Z" transform="translate(0 0.01)"/><path class="ct-2 zone-svg" d="M99,77.23l10.42-10.41L46.9,4.36,36.48,14.77ZM62.49,113.66L72.9,103.24,10.42,40.78,0,51.2Z" transform="translate(0 0.01)"/><path class="ct-3 zone-svg" d="M80.68,95.49L91.1,85.08,28.59,22.6,18.17,33Z" transform="translate(0 0.01)"/><path class="ct-4 zone-svg" d="M36.44,103.26l10.42,10.41,62.49-62.46L98.93,40.81ZM0,66.8L10.42,77.21,72.91,14.75,62.49,4.34Z" transform="translate(0 0.01)"/></svg>
                                            </span>
                                            <span>
                                                Acquired by
                                            </span>
                                            <span>
                                                <svg id="trainline-color.svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 84"><path class="tl-1 zone-svg" d="M254.33,69.79a21.67,21.67,0,0,1-2.58.11c-3.7,0-6.39-1.34-6.39-6.15V1.34H230.66V66.21c0,10.63,6.73,16.89,17.49,16.89a27.45,27.45,0,0,0,6.17-.67V69.79h0Zm49.12-19.13c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1h14.91V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H288.53v55h14.92V50.67h0Zm-117.86,0c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1H221V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H170.67v55h14.91V50.67h0ZM260.83,9.28a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H262.62v55h14.91v-55h0Zm-134.68-18a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H144.65v55h14.92v-55h0Zm228.2,35.57c-1.79,4.92-5.61,8.39-12.56,8.39-7.4,0-13.57-5.26-13.91-12.53h39.47c0-.22.22-2.46,0.22-4.59,0-17.67-10.2-28.52-27.25-28.52-14.13,0-27.14,11.41-27.14,29C346.62,73.15,360,84,375.1,84c13.57,0,22.32-7.94,25.12-17.45ZM361.64,48.54A11.93,11.93,0,0,1,374,37.69c8.52,0,12.11,5.37,12.33,10.85H361.64ZM106.75,72.81c-4.82,0-7.18-3.13-7.18-6.38,0-4.25,3-6.37,6.84-6.93l12.45-1.9v2.46c0,9.73-5.83,12.75-12.11,12.75M84.66,67.33c0,8.61,7.18,16.55,19,16.55,8.19,0,13.46-3.8,16.26-8.16a37.1,37.1,0,0,0,.56,6.6h13.68a61.5,61.5,0,0,1-.67-8.72V46.53c0-11.07-6.5-20.91-24-20.91-14.8,0-22.76,9.51-23.66,18.12L99,46.53c0.45-4.81,4-8.95,10.54-8.95,6.28,0,9.31,3.24,9.31,7.16,0,1.9-1,3.47-4.15,3.92l-13.57,2C91.95,52,84.66,57.49,84.66,67.34M79.05,27.07a34,34,0,0,0-3.48-.22c-4.71,0-12.34,1.34-15.7,8.61V27.3H45.42v55H60.33V57.15c0-11.85,6.62-15.55,14.24-15.55a22.48,22.48,0,0,1,4.49.45v-15h0ZM10,43.73V66.1c0,10.63,6.73,17,17.49,17a21.81,21.81,0,0,0,8.41-1.34V69.46a21.68,21.68,0,0,1-4.6.45c-4.26,0-6.5-1.57-6.5-6.38V43.73H10ZM24.56,24a12.75,12.75,0,0,0,.22-3V10.85H11.33v7.6A9.43,9.43,0,0,1,9.87,24H24.56ZM0,27.29v13.2H5.61c10,0,16-5.26,18.39-13.2H0Zm27.25,0a20.22,20.22,0,0,1-9.08,13.2H35.88V27.29H27.25Z" transform="translate(0 0)"/></path></svg>
                                            </span>
                                        </span>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/frichti.png' alt='Frichti' class='no-scroll'>-->
                                        <svg class='svg-openclassrooms' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 2355 1485" style="enable-background:new 0 0 2355 1485;" xml:space="preserve">
                                        <g>
                                            <path class="st0 zone-svg" d="M1769,1485c-2.8-0.7-5.6-1.5-8.4-2.2c-20-5.5-32.9-18.3-36.4-38.7c-5.2-31.2-5-62.8-1.1-94
                                                c3.4-27.4,22.2-42.8,49.9-44.8c9.3-0.7,18.6-0.1,27.7,2.4c24.8,6.9,35.9,24.9,37.8,48.9c2.2,27.2,2.8,54.6-0.6,81.8
                                                c-3.2,25.8-19.7,41.9-45.4,45.8c-0.9,0.1-1.7,0.6-2.6,1C1783,1485,1776,1485,1769,1485z M1800,1393.4
                                                C1800,1393.4,1800.1,1393.4,1800,1393.4c0.1-12.7,0.4-25.3,0-38c-0.3-12.7-7.1-18.8-19.7-18.6c-12.3,0.2-20,7.7-20.2,21.2
                                                c-0.4,22-0.3,44-0.2,66c0,4.5,0.4,9,1.2,13.4c1.9,10.8,8.3,16.1,18.9,16.1c12.3,0.1,19.4-6.8,19.9-20.6
                                                C1800.4,1419.8,1800,1406.6,1800,1393.4z"/>
                                            <path class="st0 zone-svg" d="M1925,1485c-2.8-0.8-5.6-1.5-8.4-2.3c-20.4-5.7-33.2-18.9-36.4-39.8c-4.8-31.3-4.7-62.9-0.7-94.1
                                                c4-30.9,31.6-47.9,66-43.3c30.9,4.1,47.7,21.5,49.5,52.7c1.6,26.7,2.8,53.7-0.8,80.3c-3.7,27-19.3,41.4-46.5,45.7
                                                c-0.6,0.1-1.1,0.5-1.6,0.8C1939,1485,1932,1485,1925,1485z M1956.1,1393.5c0,0,0.1,0,0.1,0c0-12.7,0.5-25.3-0.1-38
                                                c-0.7-14-7.5-19.5-21.5-18.5c-10.7,0.7-17.8,7.2-18.1,20c-0.7,25.8-1.6,51.7,0.5,77.4c1.2,13.8,8,19.5,20.6,19.1
                                                c11.2-0.4,17.9-7.2,18.4-20.5C1956.5,1419.8,1956.1,1406.6,1956.1,1393.5z"/>
                                            <path class="st1 zone-svg" d="M243,1485c-3.8-1-7.6-1.9-11.3-3.1c-20.9-6.6-31.8-21.6-34.6-42.7c-3.7-28.7-3.5-57.6-0.8-86.2
                                                c3.2-33.4,30.5-52.2,66.5-47.6c29.8,3.8,45.8,18.6,49.1,48.6c3.1,28.5,3.2,57.2-0.3,85.7c-3,24.6-20,40.5-44.6,44.3
                                                c-1.1,0.2-2.1,0.7-3.1,1C257,1485,250,1485,243,1485z M274,1393.5C274,1393.5,274,1393.5,274,1393.5c0-12.8,0.3-25.7,0-38.5
                                                c-0.3-12-6.7-17.9-18.6-18.2c-12.4-0.3-20.8,6.6-21.1,19.6c-0.5,25.3-0.2,50.6,0,75.9c0,2.8,0.9,5.6,1.7,8.3
                                                c2.6,8.6,7.9,12.6,16.8,12.8c13.1,0.4,20.5-6.6,21.1-21C274.4,1419.5,274,1406.5,274,1393.5z"/>
                                            <path class="st0 zone-svg" d="M1471,1485c-2.3-0.6-4.6-1.4-7-1.9c-18.2-3.6-30.2-15.1-39.2-30.5c-1.1-1.9-0.9-2.8,0.9-3.9
                                                c8.4-5.4,16.7-10.9,24.9-16.6c3.1-2.1,3.2,0.6,4.1,2.1c9.1,16,23.7,23.2,38.9,18.8c7.7-2.2,13.4-6.7,14.4-15.3
                                                c1.1-9.5-1.7-15-10.8-19.2c-13.3-6.1-27.1-11.1-40.1-17.6c-27.7-13.7-38.2-43.6-25-69.7c8.3-16.4,22.9-23.6,40.3-25.8
                                                c26.8-3.3,49.3,4.4,65.7,26.9c2.2,3,1.8,4.1-1.1,5.9c-7.3,4.6-14.6,9.3-21.6,14.3c-2.8,2-3.9,1.3-5.7-1.3
                                                c-7.8-11.3-18.3-17.2-32.4-15.4c-7.4,1-12.7,4.7-14.6,12.3c-1.9,7.6,1,13.6,7.2,17.7c11.2,7.4,24.4,10.3,36.8,15.1
                                                c31.6,12.1,45.9,41.1,34.4,71.2c-7.2,18.8-22.2,27.9-41,31.8c-1.1,0.2-2.1,0.7-3.1,1.1C1488.3,1485,1479.7,1485,1471,1485z"/>
                                            <path class="st0 zone-svg" d="M2280,1485c-1.4-1.9-3.6-1.4-5.4-1.8c-18.4-3.6-30.4-15.4-39.6-30.9c-1.5-2.6,0.4-3.1,1.8-4
                                                c7.7-5.2,15.6-10.2,23.3-15.5c2.8-2,3.7-1.4,5.2,1.5c8.4,15.7,23.3,22.9,38.5,18.8c8.8-2.3,13.9-7.8,15-16.1
                                                c1.1-8.3-1.9-14.2-10.7-18.3c-13.5-6.3-27.7-11.4-41-18c-28-14-38.2-46.7-22.8-72.2c8.6-14.2,22.1-20.7,38-22.8
                                                c27-3.6,49.6,4,66.4,26.5c2.3,3,2,4.3-1.2,6.3c-7.2,4.4-14.3,9.1-21.2,14.1c-2.9,2.1-4,1.5-6-1.3c-7.6-10.9-17.8-16.8-31.5-15.3
                                                c-7.6,0.8-13.2,4.4-15.4,12.1c-2,7.3,1,14.2,8.2,18.7c8.7,5.5,18.6,7.8,28.1,11.4c8.1,3.1,16.1,6.2,23.4,10.9
                                                c12.3,7.8,18.2,19.7,22,33c0,6,0,12,0,18c-2.8,16.1-10.6,28.8-25,37.1c-7.5,4.3-15.8,5.9-24,7.9C2297.3,1485,2288.7,1485,2280,1485
                                                z"/>
                                            <path class="st0 zone-svg" d="M1328,1485c-11.4-2.8-22.7-5.6-31.7-14c-5.7-5.3-10.1-11.4-14.3-17.9c-1.6-2.5-0.8-3.7,1.4-5
                                                c7.7-5,15.4-9.9,22.9-15.2c2.9-2.1,4-1.8,5.7,1.4c8.1,15.6,23,22.8,38.4,18.6c7.8-2.1,13.4-6.7,14.6-15.1c1.3-9.1-1.3-14.8-10.3-19
                                                c-12.1-5.7-24.8-10.4-37-15.9c-28.6-13-40.6-38.9-30.7-66.5c7-19.7,22.8-28.4,42.3-30.9c26.8-3.5,49.3,4.4,65.8,26.8
                                                c2.1,2.9,2,4.1-1.1,6c-7.3,4.6-14.5,9.4-21.6,14.3c-2.6,1.8-3.7,1.7-5.7-1.2c-7.8-11.5-18.5-17.5-32.8-15.4
                                                c-7.2,1.1-12.3,4.7-14.1,12.2c-1.8,7.4,0.8,13.2,6.7,17.4c8.8,6.3,19.4,8.5,29.2,12.4c6.6,2.6,13.4,4.8,19.6,8.5
                                                c20.2,11.9,29.2,31.3,25.6,55.6c-3,20.1-18.3,35.8-39.9,41c-2.3,0.6-4.6,1.3-7,2C1345.3,1485,1336.7,1485,1328,1485z"/>
                                            <path class="st0 zone-svg" d="M882,1485c-5.8-1.7-11.9-2.7-17.4-5.1c-17.6-7.7-27.9-21.4-29.8-40.5c-2.9-29.2-3.5-58.7-0.2-87.7
                                                c3.5-30.5,24.5-46.4,57.6-47.1c8.7-0.2,17.3,0.8,25.6,3.7c25.6,8.9,31.2,29.9,32.3,52.6c0.2,3.2-2.1,2.3-3.7,2.4
                                                c-10,0-20-0.1-30,0.1c-3.4,0.1-4.3-0.7-4.5-4.3c-0.5-14.8-7.3-22.8-18.9-22.8c-10.8,0-19.4,6.8-20,17.6
                                                c-1.4,27.3-1.6,54.6,0.1,81.9c0.7,10.7,7.5,16.3,18.6,17.2c9.3,0.8,16.5-4.4,19.3-14.4c1-3.7,2-7.6,1.8-11.3
                                                c-0.3-5.2,1.8-5.9,6.3-5.7c9.5,0.3,19,0.1,28.5,0.1c1.8,0,3.7-0.4,3.7,2.5c-0.2,18.1-2.9,35.2-17.7,47.9c-8.1,7-17.6,10.5-28,12.1
                                                c-0.9,0.1-2.1-0.4-2.5,1C896,1485,889,1485,882,1485z"/>
                                            <path class="st1 zone-svg" d="M400,0c1.7,27.2,3.3,54.4,5.1,81.6c0.2,3.5-0.4,5.2-4.2,6.2c-33.6,8.7-67.1,17.6-100.6,26.7
                                                c-3.8,1-5,0.1-5.4-3.6c-0.4-3.6-0.7-7.4-2.1-10.7c-4.7-11.2,0-18.2,8.2-25.8C331.3,46.3,364,21.6,399,0C399.3,0,399.7,0,400,0z"/>
                                            <path class="st2 zone-svg" d="M0,423c2.9-18.4,10.4-34.8,21.8-49.5c5.9-7.7,17-8.5,23-1.3c15.7,18.7,31.3,37.5,47.1,56.2
                                                c2.6,3,2.3,3.9-1.7,4.8c-28.6,6.6-57.2,13.5-85.8,20.3c-1.4,0.3-3,0.3-4.4,0.5C0,443.7,0,433.3,0,423z"/>
                                            <path class="st3 zone-svg" d="M2355,883c-2.8,7.6-8.7,8.2-15.9,8c-20.5-0.4-41-0.3-61.5-0.1c-4,0-5-1.2-4.9-5c0.2-16.5,0.1-33,0.1-50.3
                                                c4.1,2.3,7.7,4.2,11.2,6.2c22,12.4,44,24.9,66.1,37.2c1.5,0.8,2.8,2.5,4.9,1.9C2355,881.7,2355,882.3,2355,883z"/>
                                            <path class="st0 zone-svg" d="M2167.8,1339.6c-5.6,22.1-10.7,42.3-15.8,62.5c-6.2,24.7-12.5,49.3-18.5,74c-0.8,3.2-1.9,4.3-5.3,4.2
                                                c-7.3-0.4-16.5,2.3-21.4-1.2c-4.5-3.3-4.4-13-6.2-19.9c-10-38.6-19.9-77.2-29.9-115.8c-0.3-1.2-0.7-2.4-0.8-2.6
                                                c0,11.9,0,24.7,0,37.5c0,32.8,0,65.6,0.2,98.5c0,3-1,3.5-3.7,3.5c-8.5-0.2-17-0.2-25.5,0c-2.9,0.1-3.6-1-3.6-3.7
                                                c0.1-54.8,0.1-109.6,0-164.5c0-3,0.8-4,3.9-4c14.5,0.2,29,0.2,43.5,0c3.5-0.1,4.1,1.8,4.8,4.3c9.5,35,20.7,69.4,28.7,104.8
                                                c0.1,0.6,0.5,1.1,1.3,2.9c4.8-26.4,12.5-50.9,19.4-75.5c3.1-10.9,6.2-21.7,9.2-32.6c0.7-2.8,1.9-3.9,5-3.9c14.3,0.2,28.7,0.2,43,0
                                                c3.3,0,4.1,0.9,4.1,4.2c-0.1,54.7-0.1,109.3,0,164c0,3.4-1.1,4.1-4.2,4c-8.3-0.2-16.7-0.2-25,0c-3.3,0.1-4.1-0.8-4.1-4.1
                                                c0.5-44.1-0.9-88.3,1.5-132.4C2168.5,1343,2168.2,1342.3,2167.8,1339.6z"/>
                                            <path class="st1 zone-svg" d="M701.4,1369.5c1.4,35,0.1,69.9,0.7,104.8c0.1,4.8-1,6.3-5.9,6c-8.5-0.5-17-0.2-25.5-0.1
                                                c-2.9,0.1-3.6-0.9-3.6-3.7c0.1-54.8,0.1-109.6,0-164.4c0-3.6,1.4-4,4.4-4c8.8,0.2,17.7,0.3,26.5,0c4-0.1,6.2,1.1,8.1,4.7
                                                c16.9,32,35.8,62.9,50.7,94.3c0-9.4,0-20.1,0-30.9c-0.1-21.5-0.1-43-0.3-64.5c0-3,1.2-3.6,3.9-3.5c9.2,0.1,18.3,0.2,27.5,0
                                                c3.3-0.1,3.8,1.3,3.8,4.1c-0.1,54.6-0.1,109.3,0,163.9c0,3.4-1.1,4.2-4.3,4.1c-7.5-0.2-15-0.3-22.5,0c-3.5,0.1-5.3-1.1-6.9-4.2
                                                C739.4,1440.5,717.8,1406.4,701.4,1369.5z"/>
                                            <path class="st0 zone-svg" d="M1699,1480.2c-13.3,0-26.1-0.1-38.9,0c-3.1,0-3.3-2.3-4.1-4.2c-9.7-20.8-19.4-41.5-28.8-62.4
                                                c-3-6.5-8.3-3.3-12.4-3.4c-3.5,0-1.6,4-1.6,6c-0.2,20-0.2,40,0,60c0,2.9-0.5,4-3.8,4c-10-0.2-20-0.2-30,0c-3.1,0.1-3.9-0.9-3.9-3.9
                                                c0.1-54.6,0.1-109.3,0.1-163.9c0-1.7-1-4.3,2.5-4.2c25.4,0.7,51-1.8,76.3,1.8c23.5,3.3,37,16.7,39.6,38.2
                                                c3.4,28.4-5.6,45.6-28.9,54.7c-3.7,1.4-2.4,2.8-1.3,5c11.2,22.8,22.4,45.6,33.5,68.5C1697.8,1477.4,1698.3,1478.6,1699,1480.2z
                                                 M1613,1358.6c0,2.5,0,5,0,7.5c0,17.3,0,17.3,17.6,16.1c20.5-1.3,26.9-9.1,24.6-29.6c-1.2-10.2-6.4-15.7-16.6-16.6
                                                c-7.3-0.7-14.6-0.4-21.9-0.9c-3.3-0.2-3.8,1.1-3.8,4C1613.1,1345.6,1613,1352.1,1613,1358.6z"/>
                                            <path class="st1 zone-svg" d="M509.2,1393.8c0-27,0.1-54-0.1-81c0-3.6,0.7-4.8,4.6-4.8c35.5,0.2,71,0.1,106.4,0c3.6,0,5,0.8,4.8,4.6
                                                c-0.3,7.5-0.3,15,0,22.5c0.1,3.7-1,4.8-4.7,4.7c-23-0.2-46,0-69-0.2c-3.4,0-4.6,0.7-4.5,4.3c0.3,9.3,0.2,18.7,0,28
                                                c-0.1,3.3,0.9,4.2,4.2,4.1c15-0.2,30,0.1,45-0.2c3.8-0.1,4.8,1.1,4.7,4.8c-0.3,7.5-0.3,15,0,22.5c0.2,3.9-1.2,4.7-4.9,4.6
                                                c-14.8-0.2-29.7,0-44.5-0.2c-3.3,0-4.3,0.9-4.2,4.2c0.2,10.5,0.3,21,0,31.5c-0.1,3.8,1,4.7,4.7,4.7c24.7-0.2,49.3,0,74-0.2
                                                c3.4,0,4.6,0.6,4.5,4.3c-0.3,8-0.2,16,0,24c0.1,2.9-0.5,4.1-3.8,4c-37.8-0.1-75.6-0.1-113.4,0c-3.6,0-3.9-1.5-3.9-4.4
                                                C509.2,1448.5,509.2,1421.2,509.2,1393.8z"/>
                                            <path class="st4 zone-svg" d="M1281,835.4c0,17.7-0.1,35.3,0.1,53c0,3.3-0.9,4.2-4.2,4.2c-35-0.1-70-0.1-105,0c-3.3,0-4.2-0.9-4.2-4.2
                                                c0.2-35.6,0.2-71.3,0.2-106.9c0-2.8,0.7-3.7,3.6-3.7c35.3,0.1,70.6,0.1,106,0c3.5,0,3.6,1.6,3.6,4.2
                                                C1281,799.8,1281,817.6,1281,835.4z"/>
                                            <path class="st2 zone-svg" d="M1715.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.8,5.1c-0.1,34.3-0.2,68.6,0,103c0,4.6-1.4,5.5-5.6,5.4
                                                C1749.5,1013.5,1732.5,1013.7,1715.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M598.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.9,5.1c-0.1,34.5-0.1,69,0,103.5c0,4.1-1.3,4.9-5.1,4.9
                                                C632.8,1013.6,615.7,1013.7,598.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M2027.1,956.9c0-17.3,0.1-34.7-0.1-52c0-3.6,0.8-4.9,4.7-4.9c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1,4.5,4.5
                                                c-0.1,34.8-0.1,69.7,0,104.5c0,3.9-1.3,4.7-4.9,4.7c-34.3-0.1-68.7-0.1-103,0c-4.2,0-5.4-1.2-5.3-5.3
                                                C2027.3,991.2,2027.1,974.1,2027.1,956.9z"/>
                                            <path class="st5 zone-svg" d="M606,783.5c-3.8,35.6-7.5,70.9-11.2,106.1c-0.3,2.9-1.4,3.5-4.1,3.2c-35.1-4-70.1-7.9-105.2-11.7
                                                c-2.3-0.3-3.6-0.5-3.3-3.4c3.9-35.4,7.8-70.8,11.5-106.2c0.3-3.1,1.2-3.8,4.2-3.5c34.7,3.9,69.5,7.7,104.2,11.5
                                                C604.9,779.9,607.2,780.2,606,783.5z"/>
                                            <path class="st2 zone-svg" d="M1101.9,532.3c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.9,0.9,4.8,4.7c-0.1,34.6-0.1,69.3,0,103.9
                                                c0,3.7-1,4.8-4.7,4.8c-33.6-0.1-67.3-0.2-101,0c-4.3,0-4.4-1.8-4.8-5.3c-4-34.4-2.4-68.8-2.8-103.3c0-4,1.2-5,5-5
                                                C1067.3,532.5,1084.6,532.3,1101.9,532.3z"/>
                                            <path class="st6 zone-svg" d="M735.1,335.5c0.4,3.2-2.6,2.9-4.4,3.4C699.1,347,667.6,355,636,363c-9.8,2.5-9.8,2.4-12.3-7.5
                                                c-8-31.4-15.9-62.8-24.1-94.2c-1.1-4.3-0.1-5.7,4.1-6.8c33.6-8.4,67-16.9,100.5-25.6c2.7-0.7,3.8-0.3,4.5,2.4
                                                c8.6,34.2,17.4,68.3,26.1,102.5C734.9,334.4,735,334.9,735.1,335.5z"/>
                                            <path class="st6 zone-svg" d="M2140.1,343.5c0,17.3-0.1,34.7,0.1,52c0,3.4-0.8,4.6-4.4,4.6c-34.8-0.1-69.7-0.1-104.5,0
                                                c-3.4,0-4.2-1.1-4.2-4.3c0.1-34.8,0.1-69.7,0-104.5c0-3.2,0.8-4.3,4.2-4.3c34.8,0.1,69.7,0.1,104.5,0c3.6,0,4.5,1.2,4.4,4.6
                                                C2140,308.8,2140.1,326.2,2140.1,343.5z"/>
                                            <path class="st7 zone-svg" d="M2263,343.5c0,17.5-0.1,35,0.1,52.4c0,3.3-0.9,4.1-4.2,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-1-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.1C2262.9,308.5,2263,326,2263,343.5z"
                                                />
                                            <path class="st7 zone-svg" d="M1101.5,409.8c17.3,0,34.7,0.1,52-0.1c3.6,0,4.8,0.8,4.8,4.6c-0.2,34.7-0.1,69.3,0,104c0,3.4-0.7,4.6-4.4,4.6
                                                c-34.8-0.1-69.7-0.1-104.5,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.8,1.4-4.3,4.6-4.2
                                                C1066.8,409.9,1084.2,409.8,1101.5,409.8z"/>
                                            <path class="st4 zone-svg" d="M1281,466.5c0,17.3-0.1,34.6,0.1,52c0,3.4-0.7,4.5-4.3,4.5c-34.8-0.1-69.6-0.2-104.4,0c-4,0-4.6-1.3-4.6-4.8
                                                c0.1-34.6,0.1-69.3,0-103.9c0-3.5,0.9-4.4,4.4-4.4c34.8,0.1,69.6,0.2,104.4,0c4,0,4.5,1.3,4.5,4.8
                                                C1280.9,431.8,1281,449.2,1281,466.5z"/>
                                            <path class="st6 zone-svg" d="M1592,522.9c-17,0-34-0.1-50.9,0.1c-4,0-5-1.1-5-5.1c0.1-34.5,0.1-68.9,0-103.4c0-3.6,1-4.9,4.8-4.9
                                                c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,1.1,4.5,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.9-4.8,4.8
                                                C1626.9,522.8,1609.5,522.9,1592,522.9z"/>
                                            <path class="st7 zone-svg" d="M1715.5,522.8c-17.3,0-34.6-0.1-52,0.1c-3.8,0-4.7-1.1-4.6-4.8c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.6,0.7-4.8,4.6-4.8c34.6,0.2,69.3,0.2,103.9,0c3.8,0,4.7,1.1,4.6,4.8c-0.1,34.6-0.2,69.3,0,103.9c0,4.3-1.5,4.8-5.1,4.8
                                                C1749.8,522.8,1732.7,522.8,1715.5,522.8z"/>
                                            <path class="st7 zone-svg" d="M1281,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-4-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.2,1-3.8,4-3.8c35,0.1,70,0.1,105,0c3.8,0,4.2,1.4,4.2,4.6C1280.9,677,1281,694.5,1281,712z"/>
                                            <path class="st5 zone-svg" d="M1536.2,711c0-17.1,0.1-34.3-0.1-51.4c0-3.2,0.3-4.6,4.2-4.6c35,0.2,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.2
                                                c-0.1,35-0.1,69.9,0,104.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.2-0.9-4.1-4.2
                                                C1536.2,746.3,1536.2,728.6,1536.2,711z"/>
                                            <path class="st6 zone-svg" d="M1715.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.9-4.8-4.7c0.1-34.7,0.1-69.3,0-104
                                                c0-3.6,1.2-4.5,4.6-4.4c34.7,0.1,69.3,0.1,104,0c3.4,0,4.6,0.8,4.6,4.4c-0.1,34.7-0.1,69.3,0,104c0,3.8-1.2,4.7-4.8,4.7
                                                C1749.9,890.8,1732.6,890.9,1715.3,890.9z"/>
                                            <path class="st6 zone-svg" d="M1045,834.5c0-17.3,0.1-34.6-0.1-52c0-3.8,1.1-4.7,4.8-4.7c34.5,0.1,68.9,0.1,103.4,0c3.9,0,5.1,1,5.1,5
                                                c-0.1,34.5-0.1,68.9,0,103.4c0,3.8-1.2,4.7-4.8,4.7c-34.6-0.1-69.3-0.1-103.9,0c-3.5,0-4.5-1-4.5-4.5
                                                C1045.1,869.1,1045,851.8,1045,834.5z"/>
                                            <path class="st8 zone-svg" d="M1592.6,777.8c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.9,4.2,4.1c-0.1,35-0.1,69.9,0,104.9c0,3.4-1.1,4.1-4.3,4.1
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.6,0-104.4c0-3.7,1.3-4.3,4.6-4.3
                                                C1558,777.9,1575.3,777.8,1592.6,777.8z"/>
                                            <path class="st6 zone-svg" d="M922.1,343.5c0-17.2,0.1-34.3-0.1-51.5c0-3.8,0.8-5.2,4.9-5.2c34.5,0.2,68.9,0.2,103.4,0c4,0,5,1.3,5,5.1
                                                c-0.1,34.3-0.1,68.6,0,102.9c0,3.8-0.8,5.2-4.9,5.1c-34.5-0.2-68.9-0.2-103.4,0c-4.1,0-5-1.3-4.9-5.1
                                                C922.2,377.8,922.1,360.7,922.1,343.5z"/>
                                            <path class="st4 zone-svg" d="M1894.8,343.5c0,17.3-0.1,34.7,0.1,52c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-3.9-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.1,0.9-3.8,3.9-3.8c35,0.1,70,0.1,105,0c3.8,0,4.3,1.3,4.2,4.6
                                                C1894.8,308.8,1894.8,326.2,1894.8,343.5z"/>
                                            <path class="st9 zone-svg" d="M1715.5,400c-17.5,0-35-0.1-52.5,0.1c-3.3,0-4.1-0.8-4.1-4.1c0.1-35,0.1-70,0-104.9c0-3.3,0.8-4.1,4.1-4.1
                                                c35,0.1,70,0.1,104.9,0c3.3,0,4.1,0.8,4.1,4.1c-0.1,35-0.1,70,0,104.9c0,3.3-0.8,4.1-4.1,4.1C1750.5,399.9,1733,400,1715.5,400z"/>
                                            <path class="st5 zone-svg" d="M887.2,344c0,17.3-0.1,34.6,0.1,51.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-0.9-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.4,0,4.1,1,4.1,4.2C887.1,308.7,887.2,326.4,887.2,344z"/>
                                            <path class="st10 zone-svg" d="M1101.5,400c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-5.2-0.5-5.2-4.8c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.5,0.9-4.5,4.4-4.4c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.1,4.4,4.5c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.7-4.7,4.7
                                                C1136.2,399.9,1118.8,400,1101.5,400z"/>
                                            <path class="st2 zone-svg" d="M916.6,160.6c-4,30.5-8,61-12.1,91.5c-0.4,2.8-1.3,5.6-1.1,8.4c0.8,9.1-3.8,9.2-11,8.2
                                                c-31.8-4.5-63.6-8.6-95.5-12.7c-4.8-0.6-6.9-1.4-6.1-7.3c4.8-33.8,9.1-67.6,13.4-101.4c0.5-3.8,1.9-4.2,5.5-3.7
                                                c34.1,4.6,68.3,9,102.4,13.5C914.1,157.4,917.3,156.7,916.6,160.6z"/>
                                            <path class="st10 zone-svg" d="M395.9,718.1c-24.6,2.4-49.3,4.7-73.9,7.2c-3.3,0.3-4.7-0.3-5-4c-3.3-34.7-6.8-69.5-10.4-104.2
                                                c-0.3-3.2,0.3-3.9,3.4-4.2c35.1-3.5,70.1-7,105.2-10.7c2.8-0.3,3.7,0.4,4,3.3c2.2,23.2,4.6,46.3,7,69.5c1.2,11.5,2.2,23,3.6,34.5
                                                c0.4,3.6,0.3,5.4-4.2,5.6C415.6,715.7,405.8,717.1,395.9,718.1z"/>
                                            <path class="st0 zone-svg" d="M1244.6,1479.9c-6,0-13.6,2.2-17.5-0.6c-3.8-2.8-3.7-10.8-5.2-16.5c-4.2-16.5-4.2-16.5-21.5-16.5
                                                c-10.3,0-20.7,0.2-31-0.1c-3.4-0.1-4.6,1.2-5.3,4.2c-2.2,8.9-4.7,17.7-6.8,26.6c-0.6,2.7-1.6,3.5-4.3,3.4c-10-0.1-20-0.2-30,0
                                                c-3.2,0.1-3.5-1-2.8-3.8c15.6-55,31.1-110,46.6-165c0.7-2.6,1.8-3.4,4.4-3.4c13,0.1,26,0.1,39,0c2.7,0,3.8,0.9,4.5,3.4
                                                c15.8,55.1,31.7,110.1,47.7,165.2c0.9,3.2,0,3.7-2.8,3.6c-5-0.2-10,0-15,0C1244.6,1480.1,1244.6,1480,1244.6,1479.9z
                                                 M1190.9,1337.8c-6.4,26.8-12.3,51.4-18.3,75.8c-0.8,3.1,0.3,3.3,2.8,3.2c7-0.1,14,0,21,0c13.9,0,13.9,0,10.6-13.4
                                                C1201.8,1382.3,1196.6,1361.3,1190.9,1337.8z"/>
                                            <path class="st7 zone-svg" d="M507.7,489.2c-4.8,1.9-5.7-1.1-6.2-6.1c-3-33.7-6.2-67.3-9.6-100.9c-0.4-4.2,0.9-5.1,4.9-5.5
                                                c33.5-3,67-6.2,100.4-9.6c5.1-0.5,7.2,0.3,7.7,5.9c2.9,33.8,6.1,67.7,9.3,101.5c0.4,3.7-0.4,4.8-4.1,5.2
                                                C576.3,482.6,542.5,485.9,507.7,489.2z"/>
                                            <path class="st7 zone-svg" d="M2150,957c0-17.5,0.1-35-0.1-52.5c0-3.5,0.9-4.5,4.4-4.4c34.7,0.1,69.3,0.1,104,0c3.6,0,4.8,0.7,4.8,4.6
                                                c-0.2,31.8-0.1,63.6-0.1,95.5c0,4.9-8.2,13.3-13.3,13.3c-32,0-64,0-96,0.1c-3.8,0-3.8-1.8-3.8-4.6C2150,991.7,2150,974.3,2150,957z
                                                "/>
                                            <path class="st4 zone-svg" d="M1158.2,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-104.9,0c-3.2,0-4.2-0.6-4.2-4
                                                c0.2-25.7-0.2-51.3,0.2-77c0.1-9.8,1.7-19.5,2.5-29.3c0.2-2.5,1.5-2.8,3.6-2.8c34.5,0,69,0.1,103.4,0c3.4,0,3.6,1.4,3.6,4.1
                                                C1158.1,676.7,1158.2,694.4,1158.2,712z"/>
                                            <path class="st4 zone-svg" d="M1649.2,589c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.7,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0c-4.1,0-4.9-1.3-4.9-5.1
                                                c0.1-34.3,0.1-68.6,0-103c0-3.8,0.9-5.1,4.9-5.1c34.5,0.2,69,0.2,103.5,0c4.2,0,4.8,1.5,4.8,5.1
                                                C1649.1,554.7,1649.2,571.9,1649.2,589z"/>
                                            <path class="st7 zone-svg" d="M1838,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.6,0-4.9-0.7-4.8-4.6c0.2-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.3,4.4,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,4-1.6,4.6-5,4.5
                                                C1872.6,1013.4,1855.3,1013.4,1838,1013.4z"/>
                                            <path class="st6 zone-svg" d="M1224.6,645.2c-17.3,0-34.7-0.1-52,0.1c-3.7,0-4.8-1.1-4.8-4.8c0.1-34.3,0.1-68.6,0-103c0-3.7,1-4.9,4.8-4.8
                                                c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1.1,4.5,4.5c-0.1,34.5-0.1,69,0,103.5c0,4-1.5,4.6-5,4.6
                                                C1258.9,645.2,1241.8,645.2,1224.6,645.2z"/>
                                            <path class="st9 zone-svg" d="M1158.2,957.5c0,17.2-0.1,34.3,0.1,51.5c0,3.3-0.5,4.6-4.2,4.6c-35-0.1-69.9-0.1-104.9,0
                                                c-3.3,0-4.2-0.8-4.1-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.8,0,4.2,1.4,4.2,4.6
                                                C1158.1,922.5,1158.2,940,1158.2,957.5z"/>
                                            <path class="st7 zone-svg" d="M733.1,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.5,0-4.9-0.6-4.9-4.6c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.9,1.3-4.6,4.8-4.6c34.5,0.1,68.9,0.1,103.4,0c4,0,5,1.2,5,5.1c-0.1,34.3-0.2,68.6,0,102.9c0,4.4-1.5,5.1-5.4,5.1
                                                C767.4,1013.3,750.2,1013.4,733.1,1013.4z"/>
                                            <path class="st4 zone-svg" d="M922.2,956.5c0-17.2,0.1-34.3-0.1-51.5c0-3.4,0.8-4.6,4.4-4.6c34.8,0.1,69.6,0.1,104.4,0
                                                c3.3,0,4.7,0.6,4.6,4.3c-0.1,34.8-0.1,69.6,0,104.4c0,3.1-0.7,4.3-4.1,4.3c-35-0.1-70-0.1-104.9,0c-3.6,0-4.4-1.2-4.4-4.6
                                                C922.2,991.5,922.2,974,922.2,956.5z"/>
                                            <path class="st10 zone-svg" d="M1960.8,400c-17.1,0-34.3-0.1-51.4,0.1c-3.7,0-4.8-0.9-4.8-4.7c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,0.9,4.5,4.5c-0.1,34.8-0.1,69.6,0,104.4c0,3.8-1.5,4.3-4.7,4.3
                                                C1995.4,399.9,1978.1,400,1960.8,400z"/>
                                            <path class="st6 zone-svg" d="M2017.2,956.8c0,17.2-0.1,34.3,0.1,51.5c0,4-1.2,5.1-5.1,5.1c-34.1-0.1-68.3-0.1-102.4,0
                                                c-3.9,0-5.1-1.1-5.1-5.1c0.1-34.5,0.1-69,0-103.4c0-3.8,1.2-4.8,4.8-4.8c34.3,0.1,68.6,0.1,102.9,0c3.7,0,4.9,1,4.8,4.8
                                                C2017.1,922.1,2017.2,939.5,2017.2,956.8z"/>
                                            <path class="st7 zone-svg" d="M2017.2,166.1c0.1,36,0.2,71.9,0.3,107.9c0,2.5-1,3-3.3,3c-35.5-0.1-70.9-0.1-106.4,0c-2.7,0-3.3-1-3.3-3.5
                                                c0.1-35.3,0.1-70.6,0-105.9c0-2.8,0.7-3.7,3.6-3.7c32.6,0.2,65.3,0.2,97.9,0.3C2009.8,164.8,2013.5,165.5,2017.2,166.1z"/>
                                            <path class="st6 zone-svg" d="M912.2,957.5c0,17-0.1,34,0.1,51c0,3.7-1.1,4.8-4.8,4.8c-34.3-0.1-68.6-0.1-103,0c-3.7,0-4.8-1.1-4.8-4.8
                                                c0.1-34.3,0.1-68.6,0-103c0-3.7,1.1-4.8,4.8-4.8c34.3,0.1,68.6,0.1,103,0c3.7,0,4.9,1.1,4.8,4.8
                                                C912.1,922.9,912.2,940.2,912.2,957.5z"/>
                                            <path class="st1 zone-svg" d="M354.5,1394.1c0-27,0.1-54-0.1-80.9c0-3.7,0.7-5.2,4.9-5.1c24.4,0.9,49-1.9,73.3,1.9
                                                c28.2,4.4,43.5,24.2,42.6,54c-0.9,28.4-18,47.3-45.6,50c-10.7,1.1-21.6,1.4-32.4,1.7c-3.6,0.1-4.4,1.1-4.4,4.5
                                                c0.1,18.5,0,37,0.1,55.5c0,3.4-0.8,4.6-4.4,4.5c-9.8-0.2-19.7-0.3-29.5,0c-3.8,0.1-4.7-1-4.7-4.7
                                                C354.5,1448.4,354.5,1421.2,354.5,1394.1z M392.8,1361.8c0,7.3,0.1,14.6,0,22c0,2.2,0.3,3.4,2.9,3.3c7.3-0.4,14.7-0.2,21.9-1.1
                                                c10.8-1.3,17.5-10.6,17.9-23.5c0.5-15.1-4.1-22.1-16.2-24.6c-7.4-1.5-14.9-0.6-22.4-1c-3.2-0.2-4.3,0.7-4.2,4.1
                                                C393,1347.8,392.8,1354.8,392.8,1361.8z"/>
                                            <path class="st8 zone-svg" d="M856.3,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.8,0.8,4.8,4.7c-0.1,33-0.2,66,0,98.9c0,3.9-1.2,5-5,5.4
                                                c-34.2,3.3-68.4,3.6-102.7,1c-4.4-0.3-5.5-1.7-5.5-6c0.2-32.8,0.2-65.6,0-98.4c0-4.8,1.6-5.7,5.9-5.6
                                                C822.3,1023.3,839.3,1023.2,856.3,1023.2z"/>
                                            <path class="st5 zone-svg" d="M302.1,387.8c27.6,2.8,55.3,5.6,82.9,8.2c2.9,0.3,3.1,1.6,2.8,3.9c-3.7,34.7-7.5,69.4-11.1,104.2
                                                c-0.3,3.2-1.4,4.1-4.6,3.8c-35.1-3.7-70.1-7.4-105.2-10.9c-3.9-0.4-3-2.6-2.8-4.8c3.2-29.6,6.4-59.2,9.5-88.8
                                                c0.3-2.5,0.4-5,0.6-7.5c4.2,0.9,8.4,1.8,12.6,2.7C300.8,401.9,300.8,401.9,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M673.1,564.8c-2.8,18.3-3.6,36.9-2.1,55.6c1,12,0.7,12-11.4,13.5c-28.9,3.6-57.8,7.3-86.7,10.9
                                                c-2,0.3-3.6,0.8-4-2.5c-4.4-35.5-8.9-71-13.5-106.5c-0.6-4.3,2.7-3.2,4.5-3.4c22.1-2.9,44.2-5.6,66.4-8.4c12-1.5,24.1-2.9,36.1-4.7
                                                c3.7-0.5,5.3,0.1,5.7,4.2C669.5,537.2,671.3,550.9,673.1,564.8z"/>
                                            <path class="st5 zone-svg" d="M1894.8,220.4c0,17.5-0.1,35,0.1,52.5c0,3.2-0.7,4.2-4.1,4.2c-35-0.1-70-0.1-104.9,0c-3.3,0-4.1-0.8-4.1-4.1
                                                c0.1-30.3,0.1-60.6,0-90.9c0-3.1,1.1-4.2,3.9-5c34.5-9.4,69.5-15.3,105.5-13.1c3.2,0.2,3.8,1.2,3.8,4
                                                C1894.8,185.4,1894.8,202.9,1894.8,220.4z"/>
                                            <path class="st2 zone-svg" d="M553,709.5c0-16.3,0-32.6,0-48.9c0-2.6-0.3-4.6,3.7-4.7c31.8-0.5,63.5-1.1,95.3-1.9c4.2-0.1,5.1,1.2,5.3,5.2
                                                c0.8,13.1,2.1,26.3,6.2,38.8c4.8,14.7,3.1,29.6,3.8,44.5c0.4,6.6,0.3,13.3,0.6,19.9c0.1,2.8-0.8,3.7-3.7,3.8
                                                c-34.9,0.6-69.9,1.2-104.8,2c-3.8,0.1-4.7-1.2-4.7-4.8c0.2-18,0.1-35.9,0.1-53.9C554.2,709.5,553.6,709.5,553,709.5z"/>
                                            <path class="st4 zone-svg" d="M1961.5,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.4,0,4.6,0.8,4.6,4.4c-0.1,31.6-0.1,63.3,0,94.9
                                                c0,3.2-1.2,4.2-4.2,4.7c-34.4,5.4-69.1,7.8-103.9,7.9c-4,0-5-1.2-5-5.1c0.1-34,0.2-67.9,0-101.9c0-4.1,1.3-4.9,5.1-4.9
                                                C1926.9,1023.3,1944.2,1023.2,1961.5,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1838,1023.1c17.5,0,35,0.1,52.5-0.1c3.5,0,4.5,1,4.5,4.5c-0.1,34.1-0.1,68.3,0,102.4c0,2.7-0.3,4.3-3.7,4.2
                                                c-36-1.3-71.5-6.8-106.4-15.7c-2.5-0.6-3-1.9-3-4.2c0.1-29.1,0.1-58.3,0-87.4c0-3.9,2.1-3.7,4.7-3.7
                                                C1803.7,1023.2,1820.8,1023.1,1838,1023.1z"/>
                                            <path class="st8 zone-svg" d="M2140.2,834.3c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.6,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0
                                                c-4.1,0-4.9-1.3-4.9-5.1c0.2-20.2,0.1-40.3,0-60.5c0-2.7,0.5-4.6,2.8-6.3c14.1-10.6,26.2-23.2,36.8-37.1c2.4-3.1,4.8-4.2,8.7-4.2
                                                c19.8,0.2,39.7,0.2,59.5,0c4,0,5.4,0.8,5.3,5.1C2140,800,2140.2,817.2,2140.2,834.3z"/>
                                            <path class="st7 zone-svg" d="M684.1,146c-20.8-3.8-41.4-7.6-62-11.4c-13.9-2.6-27.8-5.2-41.7-7.6c-3.7-0.6-5-1.8-4.2-5.7
                                                c5-26.3,9.9-52.6,14.6-79c0.5-2.9,1.5-4.1,4.6-4.5c32.7-4.7,65.7-5.7,98.7-4.7c12.8,0.4,13.2,0.8,10.9,13.2
                                                c-5.8,31.9-11.7,63.8-17.6,95.7C687,143.9,687.6,146.9,684.1,146z"/>
                                            <path class="st4 zone-svg" d="M1649.2,343.7c0,17.3-0.1,34.7,0.1,52c0,3.5-0.9,4.4-4.4,4.4c-34.8-0.1-69.6-0.1-104.4,0
                                                c-3.7,0-4.4-1.1-4.3-4.5c0.2-18.5,0.1-37,0-55.5c0-2.4,0.5-4.4,2.1-6.4c13.2-15.7,27.3-30.5,42.3-44.5c1.6-1.5,3.3-2.4,5.7-2.4
                                                c19.7,0.1,39.3,0.2,59,0c3.6,0,4,1.3,3.9,4.3C1649.1,308.7,1649.2,326.2,1649.2,343.7z"/>
                                            <path class="st8 zone-svg" d="M979,277c-17.5,0-35-0.1-52.5,0.1c-3.5,0-4.5-0.9-4.4-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.7,1.3-4.5,4.6-4.2
                                                c25.3,2.3,49.9,7.9,74.3,14.5c10.4,2.8,20.6,6.4,31,9.4c2.8,0.8,3.6,2.1,3.6,4.9c-0.1,26.7-0.1,53.3,0,80c0,3.7-1.3,4.3-4.6,4.3
                                                C1013.7,276.9,996.3,277,979,277z"/>
                                            <path class="st8 zone-svg" d="M2140.2,466.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.7-4.8,4.6c-19.7-0.2-39.3-0.2-59,0c-3.2,0-5-0.9-6.9-3.6
                                                c-11.3-16.4-24.3-31.3-40.1-43.6c-1.7-1.3-2.5-2.8-2.5-5c0.1-19,0.1-38,0-57c0-3.2,0.8-4.3,4.2-4.3c35,0.1,70,0.1,105,0
                                                c3.5,0,4,1.3,4,4.4C2140.1,431.3,2140.2,448.8,2140.2,466.3z"/>
                                            <path class="st7 zone-svg" d="M1593.1,900.6c17.2,0,34.3,0.1,51.5-0.1c3.8,0,4.7,1.1,4.7,4.8c-0.1,34.5-0.1,69,0,103.5
                                                c0,3.6-0.7,4.9-4.6,4.8c-18.2-0.2-36.3-0.1-54.5-0.1c-2.4,0-4.4-0.5-6.3-2.2c-16.1-14.5-31.1-30.1-45.1-46.6c-1.7-2-2.6-4-2.6-6.7
                                                c0.1-17.7,0.2-35.3,0-53c0-3.5,1-4.5,4.5-4.5C1558.1,900.6,1575.6,900.6,1593.1,900.6z"/>
                                            <path class="st5 zone-svg" d="M789.8,1077.5c0,16.5-0.1,33,0.1,49.5c0,3.7-1.2,4.5-4.5,4.1c-35.9-4.4-71.1-11.9-105.6-23.1
                                                c-2.3-0.7-3-1.8-3-4.2c0.1-25.7,0.1-51.3,0-77c0-2.9,0.8-3.6,3.7-3.6c35.2,0.1,70.3,0.1,105.5,0c3.6,0,4,1.4,4,4.4
                                                C789.8,1044.1,789.8,1060.8,789.8,1077.5z"/>
                                            <path class="st5 zone-svg" d="M979.1,1023.2c17.3,0,34.7,0.1,52-0.1c3.5,0,4.5,0.9,4.5,4.4c-0.1,24-0.1,48,0,72c0,3.1-1.1,4.4-3.8,5.3
                                                c-34.4,11.8-69.6,20.1-105.6,25.1c-2.9,0.4-4.1-0.1-4.1-3.4c0.1-33.2,0.1-66.3,0-99.5c0-3.8,1.7-3.8,4.5-3.8
                                                C944.1,1023.2,961.6,1023.2,979.1,1023.2z"/>
                                            <path class="st10 zone-svg" d="M1715.6,768c-17.5,0-35-0.1-52.5,0.1c-3.2,0-4.3-0.8-4.2-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1.1-4.1,4.3-4.1
                                                c26.1,0.1,52.3,0.1,78.4,0c3.1,0,4.3,0.7,4.4,4.1c1.3,35.3,8.9,69.2,24.8,100.9c3,6,1.7,8.1-4.8,8.1
                                                C1749.3,768,1732.4,768,1715.6,768z"/>
                                            <path class="st2 zone-svg" d="M1526.7,711.9c0,17.2-0.1,34.3,0.1,51.5c0,3.7-1,4.8-4.8,4.7c-25.7-0.2-51.3-0.1-77,0c-3.3,0-4.5-0.9-5.2-4.2
                                                c-7.8-34.2-11.3-68.9-12.5-103.9c-0.1-3.9,1-5,5-5c29.8,0.2,59.6,0.2,89.5,0c3.9,0,5.1,1,5,5
                                                C1526.5,677.2,1526.7,694.5,1526.7,711.9z"/>
                                            <path class="st6 zone-svg" d="M1715.3,532.8c17.2,0,34.3,0.1,51.5-0.1c3.7,0,4.8,0.6,2.9,4.4c-15.9,32.7-23.8,67.2-23.7,103.6
                                                c0,3.4-1,4.6-4.5,4.6c-26-0.1-52-0.1-78,0c-3.4,0-4.6-0.9-4.6-4.5c0.1-34.5,0.1-69,0-103.4c0-3.9,1.3-4.7,4.9-4.7
                                                C1681,532.9,1698.1,532.8,1715.3,532.8z"/>
                                            <path class="st2 zone-svg" d="M2083.4,277c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.7-4.9-4.6c0.2-33.3,0.1-66.6,0-99.9
                                                c0-3.4,0.4-4.5,4.3-3.8c36.2,7,71.2,17.8,104.9,32.9c2.9,1.3,3.9,2.8,3.9,5.9c-0.1,21.5-0.2,43,0,64.5c0,4.4-1.5,5.1-5.4,5.1
                                                C2117.7,276.9,2100.5,277,2083.4,277z"/>
                                            <path class="st7 zone-svg" d="M1526.4,589.5c0,17.2-0.1,34.3,0.1,51.5c0,3.5-1,4.5-4.5,4.5c-30-0.1-60-0.1-90,0c-3.4,0-4.6-0.8-4.6-4.4
                                                c0.2-35.4,4.4-70.4,11.8-105c0.6-2.8,1.9-3.6,4.8-3.6c26,0.1,52,0.1,78,0c3.5,0,4.5,1.1,4.5,4.5
                                                C1526.4,554.5,1526.4,572,1526.4,589.5z"/>
                                            <path class="st2 zone-svg" d="M2206.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-4,0.1-5-1.2-4.9-5c0.1-34.3,0.2-68.7,0-103c0-4.3,1.3-4.9,5.3-5.2
                                                c10.5-0.8,19.6,2,28.7,7.4c24.6,14.6,49.7,28.4,74.7,42.3c3.1,1.7,4.5,3.6,4.4,7.3c-0.2,17.2-0.2,34.3,0,51.5c0,3.7-1,4.8-4.7,4.7
                                                C2241,890.8,2223.7,890.9,2206.3,890.9z"/>
                                            <path class="st2 zone-svg" d="M302.1,387.8c-1.3,14.1-1.3,14.1-15.2,10.9c-4.2-1-8.4-1.8-12.6-2.7c-32.5-7.7-65-15.6-97.5-22.9
                                                c-7.5-1.7-8.2-3.6-4.8-10.3c10.7-20.5,20.6-41.4,30.7-62.2c1.5-3.1,3-3.8,6.5-3c31,6.7,62.1,13.1,93.2,19.5
                                                c3.7,0.8,5.2,1.9,4.9,6.1C305.3,344.7,303.8,366.3,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M2083.5,1023.2c17.5,0,35,0.1,52.5-0.1c3.2,0,4.3,0.7,4.2,4.1c-0.2,19.3-0.1,38.7,0,58c0,2.4-0.5,3.8-3,4.9
                                                c-34.1,15.5-69.6,26.3-106.1,33.8c-3,0.6-4-0.1-4-3.4c0.1-31.2,0.1-62.3,0-93.5c0-3.7,1.5-3.9,4.5-3.9
                                                C2048.9,1023.2,2066.2,1023.2,2083.5,1023.2z"/>
                                            <path class="st5 zone-svg" d="M461.8,1006.1c-19.2-3-37.7-7.2-55.9-12.3c-14.5-4.1-28.7-9.3-43-14.3c-8.4-3-14.3-7.6-18.7-15.6
                                                c-7.2-13.3-7.7-13,5.4-21c26.5-16.2,53.1-32.3,79.6-48.6c3.1-1.9,4.4-1.7,6.4,1.5c17.9,29.7,36,59.4,54.2,89
                                                c1.7,2.8,1.9,4.3-1.2,6.1c-7.8,4.5-15.4,9.3-23,13.9C464.2,1005.5,463,1006.5,461.8,1006.1z"/>
                                            <path class="st9 zone-svg" d="M1224.3,400c-17.3,0-34.7-0.1-52,0.1c-3.9,0.1-4.6-1.1-4.6-4.7c0.1-34.7,0.1-69.3,0-104c0-3.3,0.5-4.9,4.3-4.5
                                                c3.3,0.3,6.7,0.6,10,0c15.8-2.8,27.1,3.8,37.8,15.1c17.6,18.7,34.7,37.7,50.6,57.9c7.8,9.9,12,19.9,10.9,32.7
                                                c-0.5,5.8-1.2,7.7-7.5,7.5C1257.3,399.6,1240.8,400,1224.3,400z"/>
                                            <path class="st2 zone-svg" d="M1035.4,834.6c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.8,4.9-4.7,4.9c-34.7-0.1-69.3-0.1-104,0
                                                c-3.2,0-4.8-0.5-4.7-4.3c0.2-12.3,0.2-24.7,0-37c0-2.8,0.9-4.1,3.4-5.2c33.2-13.3,60-34.8,81-63.6c1.7-2.3,3.5-3.2,6.2-3
                                                c7.3,0.3,16.9-2.4,21.3,1.3c4.5,3.8,1.2,13.7,1.3,21C1035.5,811.6,1035.4,823.1,1035.4,834.6z"/>
                                            <path class="st5 zone-svg" d="M572.9,208c-30.2,30.3-60,60.3-89.8,90.3c-4.2,4.3-8.5,8.4-12.7,12.7c-1.9,2-2.7,2.3-3.9-0.6
                                                c-10.4-25-20.9-49.9-31.5-74.8c-0.9-2.2-0.8-3.5,0.9-5.2c17-16.4,33.9-33,50.8-49.5c1.2-1.2,2.1-2.3,4.2-1.5
                                                C518.1,189,545.4,198.4,572.9,208z"/>
                                            <path class="st0 zone-svg" d="M987.8,1394.4c0-27.1,0.1-54.3-0.1-81.4c0-4,1.2-5,5-4.9c9.7,0.3,19.3,0.3,29,0c4.1-0.1,4.9,1.3,4.9,5.1
                                                c-0.1,43.1,0,86.3-0.2,129.4c0,4.8,1.4,5.6,5.8,5.6c21.6-0.2,43.3,0,65-0.2c3.7,0,5.2,0.6,5,4.7c-0.4,8-0.2,16,0,24
                                                c0.1,2.8-0.7,3.6-3.6,3.6c-35.6-0.1-71.3-0.1-106.9,0c-3.8,0-3.8-1.6-3.8-4.4C987.9,1448.7,987.8,1421.5,987.8,1394.4z"/>
                                            <path class="st2 zone-svg" d="M1167.9,956.9c0-17.2,0.1-34.3-0.1-51.5c0-3.7,0.7-5.2,4.9-5.2c34.5,0.1,69,0,103.4-0.2c3.9,0,4.8,1,5.1,4.9
                                                c0.5,7.4-1.7,13.3-6.1,19.3c-23.3,32.1-49.8,61.1-79.9,87c-2.6,2.2-5.3,2.5-8.3,2.4c-6.1-0.2-14.2,1.9-17.9-1.1
                                                c-3.9-3.2-1.1-11.6-1.2-17.7C1167.7,982.2,1167.9,969.6,1167.9,956.9z"/>
                                            <path class="st2 zone-svg" d="M676.9,834c0-17.2,0.1-34.3-0.1-51.5c0-3.7,1.1-4.4,4.7-4.8c11.2-1.2,18.8,2.1,26.2,11.7
                                                c20.2,26.3,46.8,44.6,77.9,56.3c3.1,1.2,4.4,2.4,4.4,5.9c-0.2,11.7-0.2,23.3,0,35c0,3.3-0.9,4.3-4.2,4.3
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-1-4.5-4.5C676.9,869,676.9,851.5,676.9,834z"/>
                                            <path class="st10 zone-svg" d="M979,409.9c17,0,34,0.2,50.9-0.1c4.5-0.1,5.5,1.4,5.5,5.6c-0.2,34-0.2,67.9,0,101.9c0,4.8-1.7,5.2-5.9,5.8
                                                c-12.3,1.7-19.8-3-27.2-13.3c-19.4-27-45.4-46.6-76.2-59.4c-3.2-1.3-4.2-2.9-4.1-6.2c0.2-10,0.2-20,0-30c-0.1-3.5,1.1-4.5,4.5-4.5
                                                C944.1,409.9,961.6,409.9,979,409.9z"/>
                                            <path class="st2 zone-svg" d="M2207,409.3c17,0,34,0.1,50.9-0.1c3.7,0,5.3,0.6,5.1,4.9c-0.3,11.5-0.2,23,0,34.5c0,2.9-0.9,4.5-3.4,5.9
                                                c-35.4,20.6-70.7,41.2-105.9,62c-3.8,2.3-3.8,0.6-3.8-2.5c0.1-33.3,0.1-66.6,0-99.9c0-3.7,0.9-4.8,4.7-4.8
                                                C2172.1,409.4,2189.6,409.3,2207,409.3z"/>
                                            <path class="st10 zone-svg" d="M1715.5,277c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.6-5.1-4.8c0.3-12.6,0.2-25.3,0.1-38
                                                c0-2.7,0.9-4.2,3.2-5.5c33.5-19.8,69-35.2,106.1-46.8c3.2-1,3.9-0.4,3.9,2.9c-0.1,29.3-0.1,58.6,0,87.9c0,3.8-1.5,4.2-4.7,4.2
                                                C1750.1,276.9,1732.8,277,1715.5,277z"/>
                                            <path class="st8 zone-svg" d="M686.8,404.3c34.4,3.7,69,7.4,103.6,11c3.8,0.4,5.4,1.3,4.7,5.6c-1.4,9.2-2.3,18.5-3,27.8
                                                c-0.2,2.7-1.5,3.3-3.6,3.8C748,462.3,715,484,688.2,515.8c-4.2,5-10.4,0.9-15.4,0.3c-3.4-0.4-1-4.2-0.8-6.3
                                                c3.5-33.9,7.2-67.8,10.9-101.8C683.1,405.5,683.1,403.1,686.8,404.3z"/>
                                            <path class="st6 zone-svg" d="M395.9,718.1c9.9-1,19.7-2.4,29.6-3c4.4-0.3,4.6-2,4.2-5.6c-1.4-11.5-2.4-23-3.6-34.5
                                                c19.7,1.7,39.4,3.4,59.1,4.9c2.9,0.2,4.1,1,4.1,4.1c-0.1,23.2-0.2,46.3-0.1,69.5c0,2.5-0.8,3.8-3.2,4.8
                                                c-29.5,12.7-59,25.5-88.4,38.4c-4,1.8-4.6,0.7-4.5-3.3C394.1,768.3,395,743.2,395.9,718.1z"/>
                                            <path class="st5 zone-svg" d="M1715.4,1023.2c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.8,4.2,4.1c-0.1,28-0.1,56,0,84c0,3.4-0.8,3.7-3.8,2.8
                                                c-37.2-11.2-72.7-26.5-106.4-46c-2.1-1.2-3-2.6-2.9-5.1c0.1-12,0.2-24,0-36c-0.1-3.2,1.1-3.8,4-3.8
                                                C1680.4,1023.2,1697.9,1023.2,1715.4,1023.2z"/>
                                            <path class="st5 zone-svg" d="M197.6,223.9c-31.5-3.8-62.8-7.6-94.2-11.4c-8.4-1-16.8-2.2-25.3-3c-3-0.3-3.4-1.4-2.7-4.1
                                                c1.5-6,2.9-12,3.9-18c0.8-4.9,3.2-8.4,6.8-11.7c18.7-17.3,41.7-27.9,63-41.1c1.4-0.9,2.9-0.7,4.3-0.5c9.2,1.5,18.4,3.2,27.6,4.4
                                                c3.3,0.4,4.3,2,4.9,4.9c4.7,25.7,9.5,51.3,14.4,77C200.7,222.9,201.1,224.8,197.6,223.9z"/>
                                            <path class="st8 zone-svg" d="M152,778.5c-27.5-0.8-54.7-3.7-81.7-9.2c-3.3-0.7-3.5-1.6-2.6-4.5c6.4-21.7,12.6-43.4,18.7-65.1
                                                c0.9-3.3,2.1-4.2,5.5-3.4c32.1,7.3,64.2,14.5,96.3,21.5c3.5,0.8,4.3,1.7,3.2,5.2c-5.1,17-9.9,34.1-14.7,51.2
                                                c-0.8,2.9-1.8,4.5-5.3,4.4C165,778.3,158.5,778.6,152,778.5z"/>
                                            <path class="st9 zone-svg" d="M1290.8,589c0-17.3,0.1-34.6-0.1-52c0-3.8,1-4.7,4.7-4.6c17,0.2,34,0.2,51,0c3,0,4.2,0.8,5,3.9
                                                c7.8,34.4,11.7,69.2,12.2,104.4c0.1,4.2-1.4,4.9-5.1,4.9c-20.8-0.2-41.6-0.2-62.5,0c-4,0-5.4-0.8-5.3-5.1
                                                C1291,623.3,1290.8,606.2,1290.8,589z"/>
                                            <path class="st10 zone-svg" d="M1290.9,711.2c0-17.1,0.1-34.3-0.1-51.4c0-3.5,0.6-4.9,4.6-4.9c21.1,0.2,42.3,0.2,63.4,0c3.5,0,4.5,1,4.4,4.5
                                                c-0.9,35.5-5.6,70.5-14.1,105c-0.7,2.9-2,3.6-4.8,3.6c-16.1-0.1-32.3-0.2-48.4,0c-3.9,0-5.1-0.9-5-4.9
                                                C1291,745.9,1290.9,728.5,1290.9,711.2z"/>
                                            <path class="st2 zone-svg" d="M1526.7,466.2c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.6,5.3-4.9,5.3c-24.8-0.2-49.7-0.2-74.5,0
                                                c-3.8,0-5-0.7-3.9-4.8c9.7-36.5,23.3-71.5,40.9-104.9c1.5-2.9,3.2-4.1,6.6-4c10.3,0.2,20.7,0.2,31,0c3.9-0.1,4.8,1.3,4.7,4.9
                                                C1526.6,431.5,1526.6,448.9,1526.7,466.2z"/>
                                            <path class="st5 zone-svg" d="M1781.8,778.8c14.8,21.8,32,38.9,53.2,51.8c17,10.2,35.2,17.3,54.7,20.4c4.1,0.7,5.3,2.2,5.2,6.3
                                                c-0.4,9.5-0.3,19,0,28.5c0.1,3.7-0.6,5.1-4.8,5.1c-34.6-0.2-69.3-0.1-103.9-0.1c-2.4,0-4.4,0.3-4.4-3.4
                                                C1781.9,851.8,1781.8,816.2,1781.8,778.8z"/>
                                            <path class="st5 zone-svg" d="M1526.5,834.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.8-4.8,4.7c-10.2-0.2-20.3-0.2-30.5,0
                                                c-2.7,0-4.1-0.9-5.4-3.2c-18.2-33.6-32-69-41.9-105.9c-1-3.6,0.1-4,3.3-4c25,0.1,50,0.1,75,0c3.7,0,4.3,1.1,4.3,4.5
                                                C1526.4,799.6,1526.5,816.9,1526.5,834.3z"/>
                                            <path class="st3 zone-svg" d="M155.7,664c-0.9-0.9-1.7-1.8-2.4-2.6c-20.5-22.5-35.2-48.7-49.4-75.3c-1.1-2.1-0.7-3.2,1-4.6
                                                c14.4-12.3,28.8-24.7,43.1-37.2c2.2-1.9,3.3-1.1,4.8,0.6c19.5,22.3,39.1,44.5,58.7,66.8c1.7,1.9,1.9,2.9-0.2,4.7
                                                c-17.9,15.2-35.6,30.6-53.4,45.9C157.2,662.9,156.6,663.3,155.7,664z"/>
                                            <path class="st2 zone-svg" d="M1781.9,515.8c0-2.9,0-4.1,0-5.4c0-32,0.1-63.9-0.1-95.9c0-4.2,1.2-5.3,5.3-5.2c34.1,0.2,68.3,0.2,102.4,0
                                                c4.5,0,5.7,1.3,5.5,5.7c-0.3,7.8-0.2,15.6-0.1,23.5c0,2.4-0.6,3.5-3.1,4C1845.2,450.7,1809.5,475.7,1781.9,515.8z"/>
                                            <path class="st5 zone-svg" d="M1101.2,277c-17.5,0-35-0.1-52.5,0.1c-3.1,0-3.9-0.8-3.8-3.9c0.1-25.5,0.1-51,0-76.5c0-3.1,0.3-4.1,3.7-2.8
                                                c37.9,14.5,73.7,33,107.1,56c1.9,1.3,2.5,2.8,2.4,4.9c-0.2,7.2,2.6,16.6-1,20.8c-3.6,4.4-13.4,1.1-20.5,1.2
                                                C1124.9,277.2,1113.1,277,1101.2,277z"/>
                                            <path class="st3 zone-svg" d="M610.8,1023.2c17.1,0,34.3,0.1,51.4-0.1c3.5,0,4.9,0.6,4.9,4.5c-0.2,23.8-0.2,47.6,0,71.4
                                                c0,4.2-1.2,4.1-4.5,2.9c-36.4-13.5-71-30.8-103.6-51.9c-3.8-2.4-5.2-5-5.2-9.5c0.3-17.3,0.1-17.3,17.5-17.3
                                                C584.5,1023.2,597.7,1023.2,610.8,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1101.7,1023.1c17.3,0,34.6,0.1,52-0.1c3.5,0,4.2,1,4.6,4.4c1.2,9.2-2.3,14.5-10.2,19.6
                                                c-30.9,20-63.2,36.9-97.3,50.6c-4.5,1.8-5.9,1.5-5.8-3.9c0.3-21.8,0.2-43.6,0-65.5c0-4,0.9-5.4,5.2-5.4
                                                C1067.4,1023.3,1084.5,1023.1,1101.7,1023.1z"/>
                                            <path class="st3 zone-svg" d="M2017.6,827.8c0,20.6,0,40.2,0,59.8c0,2.8-1.3,3.2-3.7,3.2c-35.3-0.1-70.6-0.1-105.9,0c-3,0-3.7-1.1-3.6-3.8
                                                c0.1-10.2,0.1-20.3,0-30.5c0-2.4,0.5-3.6,3.4-3.4C1946.6,856,1983.2,848.7,2017.6,827.8z"/>
                                            <path class="st5 zone-svg" d="M357.8,886.7c-37.7-2.9-74.9-10.3-111.3-22.2c-3.7-1.2-4.3-2.2-1.9-5.5c10.2-14.6,20.2-29.3,30-44.1
                                                c2-3.1,3.3-2.9,6.1-1c28.8,19.7,57.7,39.3,86.7,58.8c2.8,1.9,3.4,3.3,0.9,5.7C365.1,881.4,365.1,888.2,357.8,886.7z"/>
                                            <path class="st3 zone-svg" d="M1290.8,466.1c0-16.7-0.1-33.3,0.1-50c0-2-2-5.9,1.9-6c4-0.1,8.7-2.5,11.8,3.2c17.5,32.1,31.3,65.7,41.2,100.9
                                                c2.4,8.7,2.4,8.7-6.6,8.7c-14.3,0-28.7-0.2-43,0.1c-4.3,0.1-5.7-0.8-5.6-5.4C1291,500.4,1290.8,483.2,1290.8,466.1z"/>
                                            <path class="st5 zone-svg" d="M1961.3,409.5c17,0,34,0.1,50.9-0.1c4-0.1,5.4,0.8,5.4,5.1c-0.3,16-0.2,32-0.1,47.9c0,3.3-0.5,4.2-3.7,2.2
                                                c-32.1-19.9-67.4-26.4-104.6-24.4c-3.8,0.2-4.9-0.5-4.8-4.4c0.3-7.1,0.3-14.3,0-21.5c-0.2-3.9,0.9-5.1,4.9-5
                                                C1926.7,409.6,1944,409.5,1961.3,409.5z"/>
                                            <path class="st10 zone-svg" d="M2272.9,298.6c17.6,18.5,32.8,37.2,46.6,57.1c9,12.9,17.2,26.1,25.1,39.6c1.9,3.3,2.6,4.8-2.5,4.7
                                                c-21.7-0.2-43.3-0.1-65-0.1c-2.1,0-4.3,0.5-4.3-3C2272.9,364.7,2272.9,332.4,2272.9,298.6z"/>
                                            <path class="st3 zone-svg" d="M856,890.8c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.3-0.7-5.2-4.9c0.3-10.5,0.2-21,0.1-31.5c0-3.1,0.6-4.1,4-3.2
                                                c35.1,9.1,70.1,8.9,105-1c3.5-1,4.3-0.1,4.3,3.3c-0.2,11-0.2,22,0,33c0.1,3.7-1.4,4.3-4.7,4.3C890.6,890.8,873.3,890.8,856,890.8z"
                                                />
                                            <path class="st8 zone-svg" d="M2250.8,277c-33.5,0-65.6,0-97.6,0c-2.3,0-3.2-0.6-3.2-3c0.1-20.8,0.1-41.6,0-62.4c0-2.8,0.8-3,3.1-1.8
                                                C2188.4,227.5,2220.5,249.6,2250.8,277z"/>
                                            <path class="st5 zone-svg" d="M1290.8,835c0-17.5,0.1-35-0.1-52.5c0-3.5,0.5-4.9,4.5-4.8c15.1,0.3,30.3,0.2,45.5,0c3.4,0,4.6,0.2,3.4,4.2
                                                c-11.1,37.6-26.7,73.3-46.4,107.1c-1.2,2.1-2.5,4.1-5.3,3.3c-3-0.8-1.5-3.4-1.5-5C1290.8,869.9,1290.8,852.5,1290.8,835z"/>
                                            <path class="st5 zone-svg" d="M2272.8,993.2c0-9.6,0-18.7,0-27.7c0-20.3,0.1-40.6-0.1-60.9c0-3.5,0.9-4.5,4.4-4.4c21,0.2,41.9,0.1,62.9,0.1
                                                c2.6,0,4.8-0.5,2.4,3.4c-19.7,31.7-42.1,61.4-67.9,88.5C2274.3,992.3,2273.8,992.5,2272.8,993.2z"/>
                                            <path class="st6 zone-svg" d="M856.1,409.9c17,0,34,0.1,50.9-0.1c4.2-0.1,5.4,1.3,5.3,5.4c-0.3,8.6-0.2,17.3,0,26c0.1,3.4-0.9,3.8-4,2.9
                                                c-34.4-10.1-69-10.9-103.9-2.6c-3.7,0.9-4.8,0.2-4.7-3.6c0.2-7.7,0.2-15.3,0-23c-0.1-3.9,1-5.2,5-5.1
                                                C821.8,410,839,409.9,856.1,409.9z"/>
                                            <path class="st1 zone-svg" d="M2241.8,1023.2c-28.1,24.1-57.3,43.6-89,59.5c-2.7,1.4-2.9,0.3-2.9-2.1c0.1-18,0-35.9,0-53.9
                                                c0-1.9-0.2-3.6,2.7-3.5C2181.9,1023.2,2211.1,1023.2,2241.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M2335.4,409.5c-1.6,1.3-2.2,1.9-3,2.3c-18.6,10.9-37.3,21.8-55.9,32.8c-3,1.8-3.8,1.6-3.7-2
                                                c0.2-9.8,0.2-19.6,0-29.5c0-2.9,0.9-3.7,3.7-3.6C2295.6,409.5,2314.8,409.5,2335.4,409.5z"/>
                                            <path class="st5 zone-svg" d="M481.9,80.8c19.4-8.7,38.5-15.6,57.6-22.4c2.9-1,2.7,0.5,2.3,2.4c-2.2,11.2-4.4,22.4-6.5,33.7
                                                c-0.4,1.9-0.7,3.2-3,2.4C515.7,91.6,499.2,86.3,481.9,80.8z"/>
                                            <path class="st5 zone-svg" d="M2108.5,768c-9.1,0-18.3-0.1-27.4,0c-2.8,0-3.6-0.3-1.8-3.1c5.5-8.5,10.9-17.1,16-25.8c1.5-2.6,2.7-2.5,5-1.2
                                                c12.4,7.1,24.8,14.2,37.3,21c3.5,1.9,2.7,4.6,2.6,7.2c-0.2,3.4-3.1,1.7-4.7,1.7C2126.4,768.1,2117.5,768,2108.5,768z"/>
                                            <path class="st5 zone-svg" d="M1594.5,277c17.8-15,35.3-28.1,54.6-40.2c0,13.1,0,25.5,0,37.9c0,1.7-0.5,2.4-2.3,2.4
                                                C1629.9,277,1612.8,277,1594.5,277z"/>
                                            <path class="st5 zone-svg" d="M1526.5,348.4c0,18.2,0,34.6,0,51c0,2.1-1.2,2.4-2.9,2.4c-9.7,0-19.3-0.1-29,0c-2.5,0-3.4-0.4-1.9-3
                                                C1502.6,381.8,1513.4,365.5,1526.5,348.4z"/>
                                            <path class="st2 zone-svg" d="M1597.8,1023.1c16.8,0,32.1,0.1,47.4-0.1c3.1,0,4,1,4,4c-0.2,9.8-0.1,19.6-0.1,29.5c0,2,0.2,3.9-2.8,2
                                                C1629.8,1048,1614,1036.5,1597.8,1023.1z"/>
                                            <path class="st2 zone-svg" d="M1526.7,949.9c-12.4-15.9-22.4-31.1-31.8-46.8c-1.3-2.2-0.6-2.9,1.8-2.9c9,0,18,0,26.9,0c2,0,3.1,0.6,3.1,2.8
                                                C1526.6,918,1526.7,933,1526.7,949.9z"/>
                                            <path class="st5 zone-svg" d="M2126.3,532.5c-12.3,7.2-23.1,13.3-33.7,19.8c-2.7,1.6-3.1-0.2-4-1.7c-2.8-4.9-5.4-9.9-8.4-14.7
                                                c-2.1-3.3-0.5-3.4,2.2-3.4C2096.4,532.5,2110.4,532.5,2126.3,532.5z"/>
                                            <path class="st2 zone-svg" d="M311,211c-7,9.8-16.7,17.1-24.6,26c-1.3,1.5-2.4,0.6-3.4-0.2c-5.9-4.3-11.8-8.7-18.7-13.7
                                                C280.5,218.7,295.4,213.6,311,211L311,211z"/>
                                            <path class="st3 zone-svg" d="M1035.6,727.4c0,12.4,0,24.9,0,37.3c0,1.1,0.4,2.9-1,3c-6,0.2-12,0.3-17.9,0c-1.3-0.1-0.4-1.6,0.1-2.3
                                                C1023.9,753.2,1029.9,740.5,1035.6,727.4z"/>
                                            <path class="st2 zone-svg" d="M284,961c-13.5-6.9-25.7-15.8-39.5-24.1c10.6,0,20.1,0,29.6,0c1.2,0,1.9,0.6,2.2,1.6
                                                C278.8,946.1,282.8,953.1,284,961L284,961z"/>
                                            <path class="st5 zone-svg" d="M1035.5,568.6c-5.2-11.4-10-22.8-16.2-33.6c-1.2-2.1-0.4-2.6,1.7-2.5c0.2,0,0.3,0,0.5,0
                                                c14.1-0.8,14.1-0.8,14.1,13.2C1035.5,553.3,1035.5,560.9,1035.5,568.6z"/>
                                            <path class="st3 zone-svg" d="M1191.4,277c-3.9,0-6.2,0-8.5,0c-17,0-17,0-14.6-18.1c3.9,3,7.6,5.7,11.2,8.5
                                                C1183.2,270.3,1186.7,273.2,1191.4,277z"/>
                                            <path class="st5 zone-svg" d="M676.8,740.8c4.8,8.9,9,16.6,13.1,24.3c0.4,0.7,0.9,2.1,0.9,2.1c-3.7,1.7-7.7,0.3-11.5,0.8
                                                c-2,0.2-2.5-0.8-2.5-2.6C676.9,757.6,676.8,749.8,676.8,740.8z"/>
                                            <path class="st5 zone-svg" d="M522,1023.2c7.6,0,13.6,0.1,19.5,0c3.8-0.1,2.7,2.6,2.7,4.5c0,3.7-0.3,7.5-0.5,11.2c-3.8-1.1-6.3-4-9.3-6.2
                                                C530.5,1030,527,1027,522,1023.2z"/>
                                            <path class="st5 zone-svg" d="M676.8,551.5c0-6.4,0.1-11,0-15.6c-0.1-2.5,0.5-3.8,3.3-3.4c1.9,0.3,3.8,0.4,5.7,0.6c-0.7,1.6-1.4,3.2-2.2,4.8
                                                C681.5,542,679.5,546.1,676.8,551.5z"/>
                                            <path class="st5 zone-svg" d="M1180.8,1023.2c-4.5,3.4-7.7,5.9-10.9,8.2c-0.4,0.3-1.2,0.2-1.8,0.3c-0.1-2.1-0.2-4.3-0.2-6.4
                                                c-0.1-1.4,0.5-2.1,2-2.1C1173,1023.2,1176,1023.2,1180.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M1290.8,390c2.2,3.6,3.7,6,5,8.4c0.5,0.9,0.6,2.1,0.9,3.2c-1.3,0.1-2.6,0.1-4,0.2c-1.5,0.1-2-0.7-2-2.1
                                                C1290.9,397,1290.8,394.2,1290.8,390z"/>
                                            <path class="st5 zone-svg" d="M2017.2,166.1c-3.7-0.6-7.4-1.3-11.1-1.9C2009.8,164.8,2014.1,161.8,2017.2,166.1z"/>
                                            <path class="st2 zone-svg" d="M311,211c0.1-0.2,0.3-0.3,0.4-0.5c0,0.1,0,0.3-0.1,0.3C311.3,210.9,311.1,210.9,311,211
                                                C311,211,311,211,311,211z"/>
                                            <path class="st2 zone-svg" d="M284,961c0.2,0.1,0.3,0.2,0.5,0.3c-0.1,0-0.2,0-0.3,0C284.1,961.2,284.1,961.1,284,961
                                                C284,961,284,961,284,961z"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/startingdot.png' alt='Startingdot' class='no-scroll'>-->
                                        <svg class='svg-drivy' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273 103.01"><path class="dv-1 zone-svg" d="M71.18,22.1H87.54V81.42H71.18V22.1ZM46.63,24.8A28.81,28.81,0,0,0,32.72,21C14.72,21,0,34.78,0,52,0,69,14.72,82,32.72,82c5.46,0,10.36-1.08,13.91-3.24v2.7H63V3.23H46.63V24.8h0ZM33.27,69A17,17,0,0,1,16.36,52h0A17,17,0,0,1,33.27,35a15.44,15.44,0,0,1,8.46,2.43,16.65,16.65,0,0,1,4.64,4V63.09A18,18,0,0,1,33.27,69ZM117.54,22.1h16.36V81.42H117.54V22.1ZM173.45,55L159.82,22.1H142.09l25.36,59.32h11.73L204.82,22.1H187.09Zm81.82-32.9L241.91,55,228,22.1H210.27l21.82,50.15a8.14,8.14,0,0,1,0,6.2L221.18,103h17.73l9-21.3h0L273,22.1H255.27Zm-154.09-.54a8.63,8.63,0,1,1-8.73,8.63,8.63,8.63,0,0,1,8.73-8.63h0ZM125.73,0A8.63,8.63,0,1,1,117,8.62,8.63,8.63,0,0,1,125.73,0h0Z" transform="translate(0 0.01)"/></svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <svg class='svg-algolia' xmlns="http://www.w3.org/2000/svg" width="402" height="127.031" viewBox="0 0 402 127.031">
                                          <path class="algo-1 zone-svg" d="M169.907,278.234q-2.231-5.932-4.194-11.663t-4.064-11.662h-41.16l-8.258,23.325H98.991q5.241-14.494,9.831-26.816t8.98-23.389q4.389-11.072,8.717-21.15t9.044-19.962H147.23q4.719,9.882,9.045,19.962t8.718,21.15q4.389,11.067,8.978,23.389t9.832,26.816h-13.9Zm-11.928-33.865q-4.2-11.466-8.323-22.2t-8.587-20.623q-4.59,9.885-8.716,20.623t-8.194,22.2h33.82Zm57.806,35.181q-11.272-.264-15.99-4.876t-4.718-14.362V178.086l12.188-2.108v82.357a20.034,20.034,0,0,0,.524,5.009,6.909,6.909,0,0,0,1.7,3.162,7.356,7.356,0,0,0,3.148,1.779,32.461,32.461,0,0,0,4.848.989l-1.7,10.276m58.071-8.17a32.188,32.188,0,0,1-6.095,2.7,30.8,30.8,0,0,1-10.553,1.648,33.738,33.738,0,0,1-11.6-1.976,25.2,25.2,0,0,1-9.5-6.128,29.653,29.653,0,0,1-6.423-10.344,41.5,41.5,0,0,1-2.359-14.758,40.775,40.775,0,0,1,2.228-13.771,30.59,30.59,0,0,1,6.49-10.8,29.728,29.728,0,0,1,10.42-7.116,35.8,35.8,0,0,1,13.895-2.57,77.968,77.968,0,0,1,14.879,1.253q6.357,1.254,10.682,2.305v61.143q0,15.813-8.125,22.927T253.144,303a66.633,66.633,0,0,1-12.124-1.051,69.412,69.412,0,0,1-9.9-2.5l2.228-10.673a56.768,56.768,0,0,0,8.979,2.568,53.642,53.642,0,0,0,11.076,1.121q10.88,0,15.665-4.35t4.784-13.836v-2.9h0Zm-5.046-51.851a59.21,59.21,0,0,0-8.323-.462q-9.831,0-15.141,6.459t-5.309,17.128a30.228,30.228,0,0,0,1.507,10.148,20.123,20.123,0,0,0,4.064,6.984,15.9,15.9,0,0,0,5.9,4.083,18.578,18.578,0,0,0,6.882,1.318A27.483,27.483,0,0,0,267.3,263.8a22.006,22.006,0,0,0,6.424-3.227V220.518A40.416,40.416,0,0,0,268.81,219.529Zm135.453,60.023q-11.276-.267-15.992-4.876t-4.719-14.363V178.088l12.192-2.108v82.355a19.992,19.992,0,0,0,.523,5.009,6.864,6.864,0,0,0,1.706,3.162,7.293,7.293,0,0,0,3.144,1.78,32.371,32.371,0,0,0,4.85.988l-1.7,10.278m21.365-82.225a7.8,7.8,0,0,1-5.568-2.174,8.638,8.638,0,0,1,0-11.727,8.222,8.222,0,0,1,11.142,0,8.643,8.643,0,0,1,0,11.727,7.817,7.817,0,0,1-5.574,2.174h0ZM419.6,209.713h12.191v68.521H419.6V209.713ZM474.785,208a35.211,35.211,0,0,1,12.388,1.911,20.088,20.088,0,0,1,8.126,5.4,20.511,20.511,0,0,1,4.392,8.3A40.352,40.352,0,0,1,501,234.223V277.05q-1.574.262-4.391,0.724t-6.358.855q-3.54.4-7.668,0.724t-8.193.33a44.694,44.694,0,0,1-10.618-1.185,23.73,23.73,0,0,1-8.39-3.755,17.172,17.172,0,0,1-5.5-6.787,23.858,23.858,0,0,1-1.966-10.147,19.59,19.59,0,0,1,2.3-9.751,18.3,18.3,0,0,1,6.225-6.588,28.783,28.783,0,0,1,9.176-3.69,49.8,49.8,0,0,1,11.011-1.186q1.833,0,3.8.2c1.31,0.132,2.556.311,3.735,0.529s2.207,0.416,3.082.592,1.484,0.309,1.834.395v-3.426a27.708,27.708,0,0,0-.655-6,13.782,13.782,0,0,0-2.36-5.269,11.972,11.972,0,0,0-4.654-3.691,18.188,18.188,0,0,0-7.668-1.383,57.313,57.313,0,0,0-10.553.857,36.955,36.955,0,0,0-6.75,1.778l-1.442-10.146a37.5,37.5,0,0,1,7.865-2.042A67.479,67.479,0,0,1,474.785,208h0Zm1.049,61.4q4.325,0,7.669-.2a33.169,33.169,0,0,0,5.57-.724V248.058a15.693,15.693,0,0,0-4.259-1.119,47.2,47.2,0,0,0-7.145-.464,45.835,45.835,0,0,0-5.833.4,17.913,17.913,0,0,0-5.636,1.646,12.054,12.054,0,0,0-4.261,3.427,9.027,9.027,0,0,0-1.7,5.732q0,6.588,4.194,9.157t11.405,2.57h0Z" transform="translate(-99 -175.969)"/>
                                          <path class="algo-2 zone-svg" d="M340.344,225.11l-5.246,18.6,16.9-9.267A19.341,19.341,0,0,0,340.344,225.11Zm-32.5-15.2a6.455,6.455,0,0,0-9.157,0l-1.144,1.15a6.534,6.534,0,0,0,0,9.2l1.219,1.223a42.536,42.536,0,0,1,9.735-10.917Zm39.55-6.369c0.009-.14.04-0.273,0.04-0.416v-3.254a6.493,6.493,0,0,0-6.473-6.507h-11.33a6.492,6.492,0,0,0-6.472,6.507v3.2a41.727,41.727,0,0,1,24.235.473M334.947,218.32A25.779,25.779,0,1,1,309.188,244.1a25.8,25.8,0,0,1,25.759-25.779M298.885,244.1a36.062,36.062,0,1,0,36.062-36.091A36.075,36.075,0,0,0,298.885,244.1Z" transform="translate(-99 -175.969)"/>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <svg class='svg-iadvize' xmlns="http://www.w3.org/2000/svg" width="401" height="97" viewBox="0 0 401 97">
                                          <path data-name="Forme 1" class="cls-1 zone-svg" d="M213.532,206.236a7.134,7.134,0,0,1,7.02,7.052,6.9,6.9,0,0,1-13.807,0A7.094,7.094,0,0,1,213.532,206.236ZM207.8,231.625a5.617,5.617,0,1,1,11.233,0v35.733a5.617,5.617,0,1,1-11.233,0V231.625Zm52.887-23.274,28.9,56.538a5.82,5.82,0,0,1,.585,2.351,5.562,5.562,0,0,1-5.5,5.76,5.307,5.307,0,0,1-5.031-3.056l-6.318-11.872H241.847l-6.436,11.872A5.306,5.306,0,0,1,230.38,273a5.562,5.562,0,0,1-5.5-5.76,5.8,5.8,0,0,1,.585-2.351l28.9-56.538A3.417,3.417,0,0,1,260.685,208.351Zm-13.573,39.965h20.944L257.526,228.8ZM364.47,271.354l-20.125-37.378a4.682,4.682,0,0,1-.468-2.351,5.557,5.557,0,0,1,5.616-5.642,5.21,5.21,0,0,1,5.032,2.939l12.4,23.508,12.4-23.508a5.209,5.209,0,0,1,5.032-2.939,5.557,5.557,0,0,1,5.616,5.642,4.682,4.682,0,0,1-.469,2.351l-20.124,37.378A2.658,2.658,0,0,1,364.47,271.354Zm37.107-65.118a7.134,7.134,0,0,1,7.02,7.052,6.9,6.9,0,0,1-13.806,0A7.093,7.093,0,0,1,401.577,206.236Zm-5.733,25.389a5.616,5.616,0,1,1,11.232,0v35.733a5.616,5.616,0,1,1-11.232,0V231.625ZM415.617,273a2.478,2.478,0,0,1-2.106-2.587c0-.352.117-0.587,0.117-0.94l20.593-33.146H417.957a5.006,5.006,0,0,1-5.031-5.055,5.135,5.135,0,0,1,5.031-5.289h31.358a2.476,2.476,0,0,1,2.106,2.586c0,0.353-.117.587-0.117,0.94l-20.71,33.5h16.381a4.811,4.811,0,0,1,4.915,4.937A4.91,4.91,0,0,1,446.975,273H415.617Zm61.062-.232a23.393,23.393,0,0,1,.028-46.785,23.019,23.019,0,0,1,16.487,6.98A23.661,23.661,0,0,1,500,249.532a5.422,5.422,0,0,1-5.265,5.455H465.074c2,3.614,6.451,7.37,11.6,7.37a12.75,12.75,0,0,0,8.482-3.364,5.254,5.254,0,1,1,7.028,7.813A23.132,23.132,0,0,1,476.679,272.768Zm-11.593-28.624h23.2a12.039,12.039,0,0,0-11.582-7.518C471.551,236.626,467.1,239.174,465.086,244.144ZM332.441,206.236a5.567,5.567,0,0,0-5.4,5.861v17.554a23.688,23.688,0,0,0-12.614-3.624,23.357,23.357,0,0,0-.137,46.713,22.98,22.98,0,0,0,12.635-3.77,5.562,5.562,0,0,0,10.909-1.612v-55.48A5.377,5.377,0,0,0,332.441,206.236Zm-18.194,55.518a12.371,12.371,0,1,1,12.315-12.371A12.356,12.356,0,0,1,314.247,261.754Z" transform="translate(-99 -176)"/>
                                          <path data-name="Forme 1 copie" class="cls-2 zone-svg" d="M109.826,255.1a48.988,48.988,0,0,1-8.958-44.289,46.956,46.956,0,0,1,32.24-32.782c32.73-9.37,62.449,15.064,62.449,46.472a48.4,48.4,0,0,1-46.752,48.471L148.821,273H104.269a2.793,2.793,0,0,1-2.4-4.2Z" transform="translate(-99 -176)"/>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/mailjet.png' alt='Mailjet' class='no-scroll'>-->
                                        <svg class='svg-akeneo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 338.22 73.37"><defs><linearGradient id="Dégradé_sans_nom" x1="313.56" y1="-514.57" x2="382.56" y2="-514.57" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="0.97" stop-color="#9452ba"/></linearGradient><linearGradient id="Dégradé_sans_nom_2" x1="367.19" y1="-548.12" x2="367.19" y2="-482.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="1" stop-color="#fff"/></linearGradient><linearGradient id="Dégradé_sans_nom_3" x1="332.8" y1="-548.12" x2="332.8" y2="-482.12" xlink:href="#Dégradé_sans_nom_2"/><linearGradient id="Dégradé_sans_nom_4" x1="332.78" y1="-493.12" x2="332.78" y2="-545.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.23" stop-color="#4f1374"/><stop offset="0.84" stop-color="#5f2385"/></linearGradient><linearGradient id="Dégradé_sans_nom_5" x1="367.23" y1="-493.12" x2="367.23" y2="-545.12" xlink:href="#Dégradé_sans_nom_4"/></defs><path d="M109.73,38.8q0-4.68-2.38-6.5t-6.9-1.82a29.27,29.27,0,0,0-5.19.44,39.38,39.38,0,0,0-4.72,1.15A12.35,12.35,0,0,1,89,25.8a36.47,36.47,0,0,1,6-1.35,43.34,43.34,0,0,1,6.26-.48q7.93,0,12,3.61t4.12,11.54V64.57q-2.78.64-6.74,1.31a48.17,48.17,0,0,1-8.09.67,31.62,31.62,0,0,1-7-.71,14.32,14.32,0,0,1-5.31-2.3,10.66,10.66,0,0,1-3.37-4,13.55,13.55,0,0,1-1.19-6,12.12,12.12,0,0,1,5.15-10.27,16.81,16.81,0,0,1,5.47-2.54,24.87,24.87,0,0,1,6.5-.83q2.54,0,4.16.12t2.73,0.28V38.8h0Zm0,7.69q-1.19-.16-3-0.32T103.64,46q-4.92,0-7.49,1.82a6.34,6.34,0,0,0-2.58,5.55,6.82,6.82,0,0,0,.87,3.73,6,6,0,0,0,2.18,2.06,7.58,7.58,0,0,0,2.89.87,30,30,0,0,0,3,.16,36.68,36.68,0,0,0,3.77-.2,22.5,22.5,0,0,0,3.45-.59V46.49h0Z" transform="translate(0.38 -0.21)"/><path d="M128.92,7.48a18.66,18.66,0,0,1,1.94-.24c0.71,0,1.36-.08,1.94-0.08a18.29,18.29,0,0,1,2,.08,18.65,18.65,0,0,1,2,.24V65.6a18.62,18.62,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V7.48Zm8,37L151.84,24.9q1-.16,2.06-0.24t2.14-.08q1.19,0,2.26.08t2.18,0.24l-14.92,19L162.7,65.54q-1.11.16-2.14,0.24t-2.14.08q-1.11,0-2.22-.08L154,65.6Z" transform="translate(0.38 -0.21)"/><path d="M174.27,47.2q0.16,6.66,3.45,9.75T187.43,60a29.13,29.13,0,0,0,10.7-2,11.89,11.89,0,0,1,1,2.89,18.85,18.85,0,0,1,.48,3.37A26.52,26.52,0,0,1,193.86,66a40,40,0,0,1-6.94.55A26.2,26.2,0,0,1,177.41,65,16.72,16.72,0,0,1,167.1,54a28.46,28.46,0,0,1-1.19-8.44,29.9,29.9,0,0,1,1.15-8.44,19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.76,19.76,0,0,1,185.11,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6,24.35,24.35,0,0,1,1.11,7.49q0,1.11-.08,2.34t-0.16,2.1H174.27Zm20.14-5.87a15,15,0,0,0-.59-4.24,10.8,10.8,0,0,0-1.74-3.53,8.51,8.51,0,0,0-2.93-2.42,9.22,9.22,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M212.48,24.92q0.87-.16,1.7-0.24c0.56,0,1.12-.08,1.71-0.08a15.6,15.6,0,0,1,1.63.08q0.75,0.08,1.62.24,0.24,1.19.48,3.21a29.87,29.87,0,0,1,.24,3.37,16.26,16.26,0,0,1,2-2.7,15.57,15.57,0,0,1,2.81-2.42A14.52,14.52,0,0,1,232.84,24q7,0,10.31,4t3.33,11.85V65.6a18.66,18.66,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V42q0-5.63-1.75-8.29A6.16,6.16,0,0,0,231.3,31a11.19,11.19,0,0,0-4.2.79,9.33,9.33,0,0,0-3.49,2.46,12.3,12.3,0,0,0-2.42,4.32,19.71,19.71,0,0,0-.91,6.38V65.6a18.65,18.65,0,0,1-1.94.24q-1.07.08-1.94,0.08t-2-.08a18.57,18.57,0,0,1-2-.24V24.92h0.08Z" transform="translate(0.38 -0.21)"/><path d="M264.17,47.2q0.16,6.66,3.45,9.75T277.33,60A29.14,29.14,0,0,0,288,58a12,12,0,0,1,1,2.89,19,19,0,0,1,.47,3.37,26.52,26.52,0,0,1-5.7,1.7,40,40,0,0,1-6.94.55A26.19,26.19,0,0,1,267.35,65,16.72,16.72,0,0,1,257,54a28.47,28.47,0,0,1-1.19-8.44A29.94,29.94,0,0,1,257,37.12a19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.77,19.77,0,0,1,275,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6A24.32,24.32,0,0,1,292,42.79q0,1.11-.08,2.34t-0.16,2.1H264.17v0Zm20.14-5.87a15,15,0,0,0-.59-4.24A10.82,10.82,0,0,0,282,33.56,8.51,8.51,0,0,0,279,31.14a9.21,9.21,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M318.88,66.55a19.91,19.91,0,0,1-8.32-1.62,16.55,16.55,0,0,1-6-4.48,18.61,18.61,0,0,1-3.53-6.74,31.27,31.27,0,0,1,0-16.81,18.63,18.63,0,0,1,3.53-6.74,17,17,0,0,1,6-4.52,21.64,21.64,0,0,1,16.65,0,16.94,16.94,0,0,1,6,4.52,18.66,18.66,0,0,1,3.53,6.74,31.27,31.27,0,0,1,0,16.81,18.65,18.65,0,0,1-3.53,6.74,16.53,16.53,0,0,1-6,4.48A19.92,19.92,0,0,1,318.88,66.55Zm0-6.26q5.47,0,8.09-4t2.62-11q0-7-2.62-11t-8.09-3.92q-5.47,0-8,3.92t-2.58,11q0,7.06,2.58,11t8,4h0Z" transform="translate(0.38 -0.21)"/><path class="ak-1 zone-svg" d="M55.28,71.89c0.27,0.88.51,1.49,0.58,1.69h0c-1.34-19.17,9.75-26.76,13.65-39.33a4.37,4.37,0,0,1,.13-0.62,8.27,8.27,0,0,0,.2-0.86c0.64-3.49-.67-7.63-3.25-12V20.7c-0.21-.36-0.44-0.72-0.67-1.09h0c-0.43-.66-0.88-1.33-1.36-2l-0.15-.21L64,16.85l-0.42-.56-0.43-.55-0.45-.57-0.32-.4A96.15,96.15,0,0,0,47.19.21h0a94.09,94.09,0,0,1-.49,20.13,76,76,0,0,1-7.48,22.08,76,76,0,0,1-22.52-6A92.68,92.68,0,0,1-.3,25.64c0,0.6.1,1.19,0.15,1.79A1.91,1.91,0,0,0-.1,28,11.1,11.1,0,0,0,0,29.24a1.71,1.71,0,0,0,.07.59,10.91,10.91,0,0,0,.15,1.28,1.54,1.54,0,0,0,.06.52c0.07,0.54.14,1.08,0.22,1.61a1.31,1.31,0,0,0,0,.16C0.62,34,.72,34.64.82,35.25v0.14C0.91,35.94,1,36.49,1.11,37l0.06,0.33c0.09,0.5.19,1,.29,1.49a0.52,0.52,0,0,0,.06.29c0.12,0.57.24,1.14,0.37,1.7h0q0.63,2.71,1.39,5.23a0.43,0.43,0,0,1,0,.06,50.57,50.57,0,0,0,3,7.67l0.51,1h0c0.15,0.29.31,0.57,0.47,0.85h0c0.17,0.3.35,0.59,0.53,0.87h0l0.08,0.11h0c0.23,0.36.48,0.71,0.71,1L8.71,57.8v0.06c0.28,0.38.56,0.74,0.86,1.08h0c0.2,0.24.41,0.47,0.62,0.69l0.27,0.27,0.4,0.39,0.31,0.27,0.39,0.33,0.32,0.24,0.41,0.3,0.32,0.21L13,61.91l0.3,0.17,0.51,0.25,0.25,0.12a7.57,7.57,0,0,0,.78.29l0.47,0.18C28,66.71,40.58,61.79,55.78,73.45" transform="translate(0.38 -0.21)"/><path class="ak-2 zone-svg" d="M46.68,20.35A76,76,0,0,1,39.2,42.43c14.25,1.66,28.07-.51,30.45-8.81,2.6-9.06-9.17-23-22.48-33.4A92.76,92.76,0,0,1,46.68,20.35Z" transform="translate(0.38 -0.21)"/><path class="ak-3 zone-svg" d="M16.68,36.41a92.68,92.68,0,0,1-17-10.78C0.9,42.47,6,60,15,62.87c8.22,2.63,17.7-7.67,24.23-20.44A76,76,0,0,1,16.68,36.41Z" transform="translate(0.38 -0.21)"/><path class="ak-4 zone-svg" d="M28,52.37A51.23,51.23,0,0,1-.38,25.63h0c0.77,10.32,3,20.89,6.65,28.2,0.16,0.31.32,0.63,0.49,0.93v0.08q0.24,0.44.48,0.85L7.31,55.8q0.24,0.41.48,0.79L7.87,56.7l0.5,0.76,0.34,0.46L8.79,58,9,58.34c0.19,0.25.39,0.49,0.58,0.72a11.87,11.87,0,0,0,5.31,3.8L15.39,63C28,66.83,40.61,61.91,55.81,73.57,54.7,72,43.9,58.27,28,52.37Z" transform="translate(0.38 -0.21)"/><path class="ak-5 zone-svg" d="M69.65,33.62c2.6-9.06-9.18-23-22.48-33.4h0a51.39,51.39,0,0,1,6.44,38.45c-4,16.8,1.8,33.63,2.25,34.9h0C54.52,54.4,65.61,46.81,69.51,34.24A4.37,4.37,0,0,1,69.65,33.62Z" transform="translate(0.38 -0.21)"/></svg>
                                    </a>
                                </li><li class='col-2 transfered'>
                                    <a href='#'>
                                        <span class='content-transfered captain-train-trainline'>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401.99 113.69"><path class="ct-1 zone-svg" d="M184.58,36c-1.35,7.95-7.22,14.14-17.27,14.14-11.18,0-19.31-7.48-19.31-18.81s8.13-18.81,19.31-18.81c10,0,15.87,6.21,17.26,14.06l-9.45,2.18c-0.8-4.82-3.38-7.39-7.72-7.39-4.51,0-7.65,3.13-7.65,10s3.14,10,7.65,10c4.34,0,6.92-2.65,7.72-7.48,0,0,9.47,2.17,9.47,2.18m26.57-2.66-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,220.25,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0Zm55.75-17.84h-5V14.55l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16V13.5h9.5v8.12h-9.5V36.49c0,3.05,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45V47c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0ZM326,33.36l-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,335.05,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0ZM243.5,31.75c0,5.79,3.3,9.4,8.13,9.4,5.47,0,8.13-3.94,8.13-9.81s-2.65-9.73-8.13-9.73c-4.83,0-8.13,3.62-8.13,9.32v0.8h0Zm0,31H231.91V13.5H243.5v6.43c1.77-4.26,5.87-7.4,12.07-7.4,10.46,0,15.93,8.36,15.93,18.81S266,50.15,255.57,50.15c-6.2,0-10.3-3.13-12.07-7.32v20h0ZM262.93,112H251.34V76.36h11.59V112h0ZM251.35,66.3l11.55-3.45V73.46H251.35V66.3ZM377.45,49.19H365.86V13.5h11.59V19c1.93-3.94,6.28-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V49.19H390.4V29.66c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V49.19h0ZM153,84.48h-5V77.4l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16v9.89h9.5v8.12h-9.5V99.34c0,3.06,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45v7.64c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0Zm52.38,3.22a11.48,11.48,0,0,0-6.11-1.45c-4.83,0-8,2.73-8,8.92V112H179.61V76.36H191.2v6.51a10.68,10.68,0,0,1,9.9-7.48,8.19,8.19,0,0,1,5,1.45Zm25.26,8.52-5.87,1.2c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.11,3.38,4.26,0,7.64-3.21,7.64-8.28V96.21h0Zm11.43,6.11c0,1.85.8,2.65,2.25,2.65a6.63,6.63,0,0,0,3-.64v6.19a12.09,12.09,0,0,1-7.57,2.33c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.66-3.62-11.66-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V89.46c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.06l-10.78-.8C210.11,80.7,215.82,75.4,226,75.4c9.33,0,16,4.18,16,13.91v13h0ZM282.11,112H270.53V76.36h11.59V81.9c1.93-3.94,6.27-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V112H295.07V92.51c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V112h0ZM358.3,49.19H346.71V13.5H358.3V49.19h0ZM346.73,3.44L358.28,0V10.6H346.73V3.44h0Z" transform="translate(0 0.01)"/><path class="ct-2 zone-svg" d="M99,77.23l10.42-10.41L46.9,4.36,36.48,14.77ZM62.49,113.66L72.9,103.24,10.42,40.78,0,51.2Z" transform="translate(0 0.01)"/><path class="ct-3 zone-svg" d="M80.68,95.49L91.1,85.08,28.59,22.6,18.17,33Z" transform="translate(0 0.01)"/><path class="ct-4 zone-svg" d="M36.44,103.26l10.42,10.41,62.49-62.46L98.93,40.81ZM0,66.8L10.42,77.21,72.91,14.75,62.49,4.34Z" transform="translate(0 0.01)"/></svg>
                                            </span>
                                            <span>
                                                Acquired by
                                            </span>
                                            <span>
                                                <svg id="trainline-color.svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 84"><path class="tl-1 zone-svg" d="M254.33,69.79a21.67,21.67,0,0,1-2.58.11c-3.7,0-6.39-1.34-6.39-6.15V1.34H230.66V66.21c0,10.63,6.73,16.89,17.49,16.89a27.45,27.45,0,0,0,6.17-.67V69.79h0Zm49.12-19.13c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1h14.91V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H288.53v55h14.92V50.67h0Zm-117.86,0c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1H221V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H170.67v55h14.91V50.67h0ZM260.83,9.28a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H262.62v55h14.91v-55h0Zm-134.68-18a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H144.65v55h14.92v-55h0Zm228.2,35.57c-1.79,4.92-5.61,8.39-12.56,8.39-7.4,0-13.57-5.26-13.91-12.53h39.47c0-.22.22-2.46,0.22-4.59,0-17.67-10.2-28.52-27.25-28.52-14.13,0-27.14,11.41-27.14,29C346.62,73.15,360,84,375.1,84c13.57,0,22.32-7.94,25.12-17.45ZM361.64,48.54A11.93,11.93,0,0,1,374,37.69c8.52,0,12.11,5.37,12.33,10.85H361.64ZM106.75,72.81c-4.82,0-7.18-3.13-7.18-6.38,0-4.25,3-6.37,6.84-6.93l12.45-1.9v2.46c0,9.73-5.83,12.75-12.11,12.75M84.66,67.33c0,8.61,7.18,16.55,19,16.55,8.19,0,13.46-3.8,16.26-8.16a37.1,37.1,0,0,0,.56,6.6h13.68a61.5,61.5,0,0,1-.67-8.72V46.53c0-11.07-6.5-20.91-24-20.91-14.8,0-22.76,9.51-23.66,18.12L99,46.53c0.45-4.81,4-8.95,10.54-8.95,6.28,0,9.31,3.24,9.31,7.16,0,1.9-1,3.47-4.15,3.92l-13.57,2C91.95,52,84.66,57.49,84.66,67.34M79.05,27.07a34,34,0,0,0-3.48-.22c-4.71,0-12.34,1.34-15.7,8.61V27.3H45.42v55H60.33V57.15c0-11.85,6.62-15.55,14.24-15.55a22.48,22.48,0,0,1,4.49.45v-15h0ZM10,43.73V66.1c0,10.63,6.73,17,17.49,17a21.81,21.81,0,0,0,8.41-1.34V69.46a21.68,21.68,0,0,1-4.6.45c-4.26,0-6.5-1.57-6.5-6.38V43.73H10ZM24.56,24a12.75,12.75,0,0,0,.22-3V10.85H11.33v7.6A9.43,9.43,0,0,1,9.87,24H24.56ZM0,27.29v13.2H5.61c10,0,16-5.26,18.39-13.2H0Zm27.25,0a20.22,20.22,0,0,1-9.08,13.2H35.88V27.29H27.25Z" transform="translate(0 0)"/></path></svg>
                                            </span>
                                        </span>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <svg class='svg-akeneo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 338.22 73.37"><defs><linearGradient id="Dégradé_sans_nom" x1="313.56" y1="-514.57" x2="382.56" y2="-514.57" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="0.97" stop-color="#9452ba"/></linearGradient><linearGradient id="Dégradé_sans_nom_2" x1="367.19" y1="-548.12" x2="367.19" y2="-482.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="1" stop-color="#fff"/></linearGradient><linearGradient id="Dégradé_sans_nom_3" x1="332.8" y1="-548.12" x2="332.8" y2="-482.12" xlink:href="#Dégradé_sans_nom_2"/><linearGradient id="Dégradé_sans_nom_4" x1="332.78" y1="-493.12" x2="332.78" y2="-545.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.23" stop-color="#4f1374"/><stop offset="0.84" stop-color="#5f2385"/></linearGradient><linearGradient id="Dégradé_sans_nom_5" x1="367.23" y1="-493.12" x2="367.23" y2="-545.12" xlink:href="#Dégradé_sans_nom_4"/></defs><path d="M109.73,38.8q0-4.68-2.38-6.5t-6.9-1.82a29.27,29.27,0,0,0-5.19.44,39.38,39.38,0,0,0-4.72,1.15A12.35,12.35,0,0,1,89,25.8a36.47,36.47,0,0,1,6-1.35,43.34,43.34,0,0,1,6.26-.48q7.93,0,12,3.61t4.12,11.54V64.57q-2.78.64-6.74,1.31a48.17,48.17,0,0,1-8.09.67,31.62,31.62,0,0,1-7-.71,14.32,14.32,0,0,1-5.31-2.3,10.66,10.66,0,0,1-3.37-4,13.55,13.55,0,0,1-1.19-6,12.12,12.12,0,0,1,5.15-10.27,16.81,16.81,0,0,1,5.47-2.54,24.87,24.87,0,0,1,6.5-.83q2.54,0,4.16.12t2.73,0.28V38.8h0Zm0,7.69q-1.19-.16-3-0.32T103.64,46q-4.92,0-7.49,1.82a6.34,6.34,0,0,0-2.58,5.55,6.82,6.82,0,0,0,.87,3.73,6,6,0,0,0,2.18,2.06,7.58,7.58,0,0,0,2.89.87,30,30,0,0,0,3,.16,36.68,36.68,0,0,0,3.77-.2,22.5,22.5,0,0,0,3.45-.59V46.49h0Z" transform="translate(0.38 -0.21)"/><path d="M128.92,7.48a18.66,18.66,0,0,1,1.94-.24c0.71,0,1.36-.08,1.94-0.08a18.29,18.29,0,0,1,2,.08,18.65,18.65,0,0,1,2,.24V65.6a18.62,18.62,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V7.48Zm8,37L151.84,24.9q1-.16,2.06-0.24t2.14-.08q1.19,0,2.26.08t2.18,0.24l-14.92,19L162.7,65.54q-1.11.16-2.14,0.24t-2.14.08q-1.11,0-2.22-.08L154,65.6Z" transform="translate(0.38 -0.21)"/><path d="M174.27,47.2q0.16,6.66,3.45,9.75T187.43,60a29.13,29.13,0,0,0,10.7-2,11.89,11.89,0,0,1,1,2.89,18.85,18.85,0,0,1,.48,3.37A26.52,26.52,0,0,1,193.86,66a40,40,0,0,1-6.94.55A26.2,26.2,0,0,1,177.41,65,16.72,16.72,0,0,1,167.1,54a28.46,28.46,0,0,1-1.19-8.44,29.9,29.9,0,0,1,1.15-8.44,19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.76,19.76,0,0,1,185.11,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6,24.35,24.35,0,0,1,1.11,7.49q0,1.11-.08,2.34t-0.16,2.1H174.27Zm20.14-5.87a15,15,0,0,0-.59-4.24,10.8,10.8,0,0,0-1.74-3.53,8.51,8.51,0,0,0-2.93-2.42,9.22,9.22,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M212.48,24.92q0.87-.16,1.7-0.24c0.56,0,1.12-.08,1.71-0.08a15.6,15.6,0,0,1,1.63.08q0.75,0.08,1.62.24,0.24,1.19.48,3.21a29.87,29.87,0,0,1,.24,3.37,16.26,16.26,0,0,1,2-2.7,15.57,15.57,0,0,1,2.81-2.42A14.52,14.52,0,0,1,232.84,24q7,0,10.31,4t3.33,11.85V65.6a18.66,18.66,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V42q0-5.63-1.75-8.29A6.16,6.16,0,0,0,231.3,31a11.19,11.19,0,0,0-4.2.79,9.33,9.33,0,0,0-3.49,2.46,12.3,12.3,0,0,0-2.42,4.32,19.71,19.71,0,0,0-.91,6.38V65.6a18.65,18.65,0,0,1-1.94.24q-1.07.08-1.94,0.08t-2-.08a18.57,18.57,0,0,1-2-.24V24.92h0.08Z" transform="translate(0.38 -0.21)"/><path d="M264.17,47.2q0.16,6.66,3.45,9.75T277.33,60A29.14,29.14,0,0,0,288,58a12,12,0,0,1,1,2.89,19,19,0,0,1,.47,3.37,26.52,26.52,0,0,1-5.7,1.7,40,40,0,0,1-6.94.55A26.19,26.19,0,0,1,267.35,65,16.72,16.72,0,0,1,257,54a28.47,28.47,0,0,1-1.19-8.44A29.94,29.94,0,0,1,257,37.12a19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.77,19.77,0,0,1,275,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6A24.32,24.32,0,0,1,292,42.79q0,1.11-.08,2.34t-0.16,2.1H264.17v0Zm20.14-5.87a15,15,0,0,0-.59-4.24A10.82,10.82,0,0,0,282,33.56,8.51,8.51,0,0,0,279,31.14a9.21,9.21,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M318.88,66.55a19.91,19.91,0,0,1-8.32-1.62,16.55,16.55,0,0,1-6-4.48,18.61,18.61,0,0,1-3.53-6.74,31.27,31.27,0,0,1,0-16.81,18.63,18.63,0,0,1,3.53-6.74,17,17,0,0,1,6-4.52,21.64,21.64,0,0,1,16.65,0,16.94,16.94,0,0,1,6,4.52,18.66,18.66,0,0,1,3.53,6.74,31.27,31.27,0,0,1,0,16.81,18.65,18.65,0,0,1-3.53,6.74,16.53,16.53,0,0,1-6,4.48A19.92,19.92,0,0,1,318.88,66.55Zm0-6.26q5.47,0,8.09-4t2.62-11q0-7-2.62-11t-8.09-3.92q-5.47,0-8,3.92t-2.58,11q0,7.06,2.58,11t8,4h0Z" transform="translate(0.38 -0.21)"/><path class="ak-1 zone-svg" d="M55.28,71.89c0.27,0.88.51,1.49,0.58,1.69h0c-1.34-19.17,9.75-26.76,13.65-39.33a4.37,4.37,0,0,1,.13-0.62,8.27,8.27,0,0,0,.2-0.86c0.64-3.49-.67-7.63-3.25-12V20.7c-0.21-.36-0.44-0.72-0.67-1.09h0c-0.43-.66-0.88-1.33-1.36-2l-0.15-.21L64,16.85l-0.42-.56-0.43-.55-0.45-.57-0.32-.4A96.15,96.15,0,0,0,47.19.21h0a94.09,94.09,0,0,1-.49,20.13,76,76,0,0,1-7.48,22.08,76,76,0,0,1-22.52-6A92.68,92.68,0,0,1-.3,25.64c0,0.6.1,1.19,0.15,1.79A1.91,1.91,0,0,0-.1,28,11.1,11.1,0,0,0,0,29.24a1.71,1.71,0,0,0,.07.59,10.91,10.91,0,0,0,.15,1.28,1.54,1.54,0,0,0,.06.52c0.07,0.54.14,1.08,0.22,1.61a1.31,1.31,0,0,0,0,.16C0.62,34,.72,34.64.82,35.25v0.14C0.91,35.94,1,36.49,1.11,37l0.06,0.33c0.09,0.5.19,1,.29,1.49a0.52,0.52,0,0,0,.06.29c0.12,0.57.24,1.14,0.37,1.7h0q0.63,2.71,1.39,5.23a0.43,0.43,0,0,1,0,.06,50.57,50.57,0,0,0,3,7.67l0.51,1h0c0.15,0.29.31,0.57,0.47,0.85h0c0.17,0.3.35,0.59,0.53,0.87h0l0.08,0.11h0c0.23,0.36.48,0.71,0.71,1L8.71,57.8v0.06c0.28,0.38.56,0.74,0.86,1.08h0c0.2,0.24.41,0.47,0.62,0.69l0.27,0.27,0.4,0.39,0.31,0.27,0.39,0.33,0.32,0.24,0.41,0.3,0.32,0.21L13,61.91l0.3,0.17,0.51,0.25,0.25,0.12a7.57,7.57,0,0,0,.78.29l0.47,0.18C28,66.71,40.58,61.79,55.78,73.45" transform="translate(0.38 -0.21)"/><path class="ak-2 zone-svg" d="M46.68,20.35A76,76,0,0,1,39.2,42.43c14.25,1.66,28.07-.51,30.45-8.81,2.6-9.06-9.17-23-22.48-33.4A92.76,92.76,0,0,1,46.68,20.35Z" transform="translate(0.38 -0.21)"/><path class="ak-3 zone-svg" d="M16.68,36.41a92.68,92.68,0,0,1-17-10.78C0.9,42.47,6,60,15,62.87c8.22,2.63,17.7-7.67,24.23-20.44A76,76,0,0,1,16.68,36.41Z" transform="translate(0.38 -0.21)"/><path class="ak-4 zone-svg" d="M28,52.37A51.23,51.23,0,0,1-.38,25.63h0c0.77,10.32,3,20.89,6.65,28.2,0.16,0.31.32,0.63,0.49,0.93v0.08q0.24,0.44.48,0.85L7.31,55.8q0.24,0.41.48,0.79L7.87,56.7l0.5,0.76,0.34,0.46L8.79,58,9,58.34c0.19,0.25.39,0.49,0.58,0.72a11.87,11.87,0,0,0,5.31,3.8L15.39,63C28,66.83,40.61,61.91,55.81,73.57,54.7,72,43.9,58.27,28,52.37Z" transform="translate(0.38 -0.21)"/><path class="ak-5 zone-svg" d="M69.65,33.62c2.6-9.06-9.18-23-22.48-33.4h0a51.39,51.39,0,0,1,6.44,38.45c-4,16.8,1.8,33.63,2.25,34.9h0C54.52,54.4,65.61,46.81,69.51,34.24A4.37,4.37,0,0,1,69.65,33.62Z" transform="translate(0.38 -0.21)"/></svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <svg class='svg-drivy' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273 103.01"><path class="dv-1 zone-svg" d="M71.18,22.1H87.54V81.42H71.18V22.1ZM46.63,24.8A28.81,28.81,0,0,0,32.72,21C14.72,21,0,34.78,0,52,0,69,14.72,82,32.72,82c5.46,0,10.36-1.08,13.91-3.24v2.7H63V3.23H46.63V24.8h0ZM33.27,69A17,17,0,0,1,16.36,52h0A17,17,0,0,1,33.27,35a15.44,15.44,0,0,1,8.46,2.43,16.65,16.65,0,0,1,4.64,4V63.09A18,18,0,0,1,33.27,69ZM117.54,22.1h16.36V81.42H117.54V22.1ZM173.45,55L159.82,22.1H142.09l25.36,59.32h11.73L204.82,22.1H187.09Zm81.82-32.9L241.91,55,228,22.1H210.27l21.82,50.15a8.14,8.14,0,0,1,0,6.2L221.18,103h17.73l9-21.3h0L273,22.1H255.27Zm-154.09-.54a8.63,8.63,0,1,1-8.73,8.63,8.63,8.63,0,0,1,8.73-8.63h0ZM125.73,0A8.63,8.63,0,1,1,117,8.62,8.63,8.63,0,0,1,125.73,0h0Z" transform="translate(0 0.01)"/></svg>
                                    </a>
                                </li><li class='col-2 transfered'>
                                    <a href='#'>
                                        <span class='content-transfered captain-train-trainline'>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401.99 113.69"><path class="ct-1 zone-svg" d="M184.58,36c-1.35,7.95-7.22,14.14-17.27,14.14-11.18,0-19.31-7.48-19.31-18.81s8.13-18.81,19.31-18.81c10,0,15.87,6.21,17.26,14.06l-9.45,2.18c-0.8-4.82-3.38-7.39-7.72-7.39-4.51,0-7.65,3.13-7.65,10s3.14,10,7.65,10c4.34,0,6.92-2.65,7.72-7.48,0,0,9.47,2.17,9.47,2.18m26.57-2.66-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,220.25,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0Zm55.75-17.84h-5V14.55l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16V13.5h9.5v8.12h-9.5V36.49c0,3.05,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45V47c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0ZM326,33.36l-5.87,1.21c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.1,3.38,4.26,0,7.64-3.21,7.64-8.28V33.36h0Zm11.43,6.11c0,1.85.81,2.65,2.25,2.65a6.64,6.64,0,0,0,3-.64v6.19A12.08,12.08,0,0,1,335.05,50c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.67-3.62-11.67-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V26.6c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.07l-10.78-.8c1.21-7.64,6.92-12.94,17.14-12.94,9.33,0,16,4.18,16,13.9v13h0ZM243.5,31.75c0,5.79,3.3,9.4,8.13,9.4,5.47,0,8.13-3.94,8.13-9.81s-2.65-9.73-8.13-9.73c-4.83,0-8.13,3.62-8.13,9.32v0.8h0Zm0,31H231.91V13.5H243.5v6.43c1.77-4.26,5.87-7.4,12.07-7.4,10.46,0,15.93,8.36,15.93,18.81S266,50.15,255.57,50.15c-6.2,0-10.3-3.13-12.07-7.32v20h0ZM262.93,112H251.34V76.36h11.59V112h0ZM251.35,66.3l11.55-3.45V73.46H251.35V66.3ZM377.45,49.19H365.86V13.5h11.59V19c1.93-3.94,6.28-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V49.19H390.4V29.66c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V49.19h0ZM153,84.48h-5V77.4l2.57-.4c3.54-.64,4.59-2.49,5.47-5.79l1.21-4.74h7.16v9.89h9.5v8.12h-9.5V99.34c0,3.06,1.45,4.34,4.18,4.34a14.23,14.23,0,0,0,5.79-1.45v7.64c-2.65,2-5.71,3.13-10.38,3.13-5.79,0-11-2.49-11-10.53v-18h0Zm52.38,3.22a11.48,11.48,0,0,0-6.11-1.45c-4.83,0-8,2.73-8,8.92V112H179.61V76.36H191.2v6.51a10.68,10.68,0,0,1,9.9-7.48,8.19,8.19,0,0,1,5,1.45Zm25.26,8.52-5.87,1.2c-3.62.72-5.87,1.61-5.87,4.42,0,2.09,1.61,3.38,4.11,3.38,4.26,0,7.64-3.21,7.64-8.28V96.21h0Zm11.43,6.11c0,1.85.8,2.65,2.25,2.65a6.63,6.63,0,0,0,3-.64v6.19a12.09,12.09,0,0,1-7.57,2.33c-4.26,0-7.4-2.25-8.45-6.27-2,4.1-6.44,6.27-12,6.27-7.16,0-11.66-3.62-11.66-9.73,0-6.83,5.15-9.73,13-11.25l10-1.77V89.46c0-3.37-1.69-5.38-5.23-5.38-3.38,0-5.07,2.09-5.71,5.06l-10.78-.8C210.11,80.7,215.82,75.4,226,75.4c9.33,0,16,4.18,16,13.91v13h0ZM282.11,112H270.53V76.36h11.59V81.9c1.93-3.94,6.27-6.51,11.67-6.51,9.65,0,12.87,6.67,12.87,14.31V112H295.07V92.51c0-5.14-1.69-8-6-8-4.67,0-7,3.7-7,9.32V112h0ZM358.3,49.19H346.71V13.5H358.3V49.19h0ZM346.73,3.44L358.28,0V10.6H346.73V3.44h0Z" transform="translate(0 0.01)"/><path class="ct-2 zone-svg" d="M99,77.23l10.42-10.41L46.9,4.36,36.48,14.77ZM62.49,113.66L72.9,103.24,10.42,40.78,0,51.2Z" transform="translate(0 0.01)"/><path class="ct-3 zone-svg" d="M80.68,95.49L91.1,85.08,28.59,22.6,18.17,33Z" transform="translate(0 0.01)"/><path class="ct-4 zone-svg" d="M36.44,103.26l10.42,10.41,62.49-62.46L98.93,40.81ZM0,66.8L10.42,77.21,72.91,14.75,62.49,4.34Z" transform="translate(0 0.01)"/></svg>
                                            </span>
                                            <span>
                                                Acquired by
                                            </span>
                                            <span>
                                                <svg id="trainline-color.svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 84"><path class="tl-1 zone-svg" d="M254.33,69.79a21.67,21.67,0,0,1-2.58.11c-3.7,0-6.39-1.34-6.39-6.15V1.34H230.66V66.21c0,10.63,6.73,16.89,17.49,16.89a27.45,27.45,0,0,0,6.17-.67V69.79h0Zm49.12-19.13c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1h14.91V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H288.53v55h14.92V50.67h0Zm-117.86,0c0-6.37,3.81-11.41,10.32-11.41,7.18,0,10.2,4.81,10.2,11v32.1H221V47.65c0-12.08-6.28-21.81-20-21.81-5.94,0-12.56,2.57-15.92,8.28V27.29H170.67v55h14.91V50.67h0ZM260.83,9.28a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H262.62v55h14.91v-55h0Zm-134.68-18a9.2,9.2,0,1,0,0-.08V9.28m16.71,18H144.65v55h14.92v-55h0Zm228.2,35.57c-1.79,4.92-5.61,8.39-12.56,8.39-7.4,0-13.57-5.26-13.91-12.53h39.47c0-.22.22-2.46,0.22-4.59,0-17.67-10.2-28.52-27.25-28.52-14.13,0-27.14,11.41-27.14,29C346.62,73.15,360,84,375.1,84c13.57,0,22.32-7.94,25.12-17.45ZM361.64,48.54A11.93,11.93,0,0,1,374,37.69c8.52,0,12.11,5.37,12.33,10.85H361.64ZM106.75,72.81c-4.82,0-7.18-3.13-7.18-6.38,0-4.25,3-6.37,6.84-6.93l12.45-1.9v2.46c0,9.73-5.83,12.75-12.11,12.75M84.66,67.33c0,8.61,7.18,16.55,19,16.55,8.19,0,13.46-3.8,16.26-8.16a37.1,37.1,0,0,0,.56,6.6h13.68a61.5,61.5,0,0,1-.67-8.72V46.53c0-11.07-6.5-20.91-24-20.91-14.8,0-22.76,9.51-23.66,18.12L99,46.53c0.45-4.81,4-8.95,10.54-8.95,6.28,0,9.31,3.24,9.31,7.16,0,1.9-1,3.47-4.15,3.92l-13.57,2C91.95,52,84.66,57.49,84.66,67.34M79.05,27.07a34,34,0,0,0-3.48-.22c-4.71,0-12.34,1.34-15.7,8.61V27.3H45.42v55H60.33V57.15c0-11.85,6.62-15.55,14.24-15.55a22.48,22.48,0,0,1,4.49.45v-15h0ZM10,43.73V66.1c0,10.63,6.73,17,17.49,17a21.81,21.81,0,0,0,8.41-1.34V69.46a21.68,21.68,0,0,1-4.6.45c-4.26,0-6.5-1.57-6.5-6.38V43.73H10ZM24.56,24a12.75,12.75,0,0,0,.22-3V10.85H11.33v7.6A9.43,9.43,0,0,1,9.87,24H24.56ZM0,27.29v13.2H5.61c10,0,16-5.26,18.39-13.2H0Zm27.25,0a20.22,20.22,0,0,1-9.08,13.2H35.88V27.29H27.25Z" transform="translate(0 0)"/></path></svg>
                                            </span>
                                        </span>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/dataaiku.png' alt='Dataiku' class='no-scroll'>-->
                                        <svg class='svg-openclassrooms' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 2355 1485" style="enable-background:new 0 0 2355 1485;" xml:space="preserve">
                                        <g>
                                            <path class="st0 zone-svg" d="M1769,1485c-2.8-0.7-5.6-1.5-8.4-2.2c-20-5.5-32.9-18.3-36.4-38.7c-5.2-31.2-5-62.8-1.1-94
                                                c3.4-27.4,22.2-42.8,49.9-44.8c9.3-0.7,18.6-0.1,27.7,2.4c24.8,6.9,35.9,24.9,37.8,48.9c2.2,27.2,2.8,54.6-0.6,81.8
                                                c-3.2,25.8-19.7,41.9-45.4,45.8c-0.9,0.1-1.7,0.6-2.6,1C1783,1485,1776,1485,1769,1485z M1800,1393.4
                                                C1800,1393.4,1800.1,1393.4,1800,1393.4c0.1-12.7,0.4-25.3,0-38c-0.3-12.7-7.1-18.8-19.7-18.6c-12.3,0.2-20,7.7-20.2,21.2
                                                c-0.4,22-0.3,44-0.2,66c0,4.5,0.4,9,1.2,13.4c1.9,10.8,8.3,16.1,18.9,16.1c12.3,0.1,19.4-6.8,19.9-20.6
                                                C1800.4,1419.8,1800,1406.6,1800,1393.4z"/>
                                            <path class="st0 zone-svg" d="M1925,1485c-2.8-0.8-5.6-1.5-8.4-2.3c-20.4-5.7-33.2-18.9-36.4-39.8c-4.8-31.3-4.7-62.9-0.7-94.1
                                                c4-30.9,31.6-47.9,66-43.3c30.9,4.1,47.7,21.5,49.5,52.7c1.6,26.7,2.8,53.7-0.8,80.3c-3.7,27-19.3,41.4-46.5,45.7
                                                c-0.6,0.1-1.1,0.5-1.6,0.8C1939,1485,1932,1485,1925,1485z M1956.1,1393.5c0,0,0.1,0,0.1,0c0-12.7,0.5-25.3-0.1-38
                                                c-0.7-14-7.5-19.5-21.5-18.5c-10.7,0.7-17.8,7.2-18.1,20c-0.7,25.8-1.6,51.7,0.5,77.4c1.2,13.8,8,19.5,20.6,19.1
                                                c11.2-0.4,17.9-7.2,18.4-20.5C1956.5,1419.8,1956.1,1406.6,1956.1,1393.5z"/>
                                            <path class="st1 zone-svg" d="M243,1485c-3.8-1-7.6-1.9-11.3-3.1c-20.9-6.6-31.8-21.6-34.6-42.7c-3.7-28.7-3.5-57.6-0.8-86.2
                                                c3.2-33.4,30.5-52.2,66.5-47.6c29.8,3.8,45.8,18.6,49.1,48.6c3.1,28.5,3.2,57.2-0.3,85.7c-3,24.6-20,40.5-44.6,44.3
                                                c-1.1,0.2-2.1,0.7-3.1,1C257,1485,250,1485,243,1485z M274,1393.5C274,1393.5,274,1393.5,274,1393.5c0-12.8,0.3-25.7,0-38.5
                                                c-0.3-12-6.7-17.9-18.6-18.2c-12.4-0.3-20.8,6.6-21.1,19.6c-0.5,25.3-0.2,50.6,0,75.9c0,2.8,0.9,5.6,1.7,8.3
                                                c2.6,8.6,7.9,12.6,16.8,12.8c13.1,0.4,20.5-6.6,21.1-21C274.4,1419.5,274,1406.5,274,1393.5z"/>
                                            <path class="st0 zone-svg" d="M1471,1485c-2.3-0.6-4.6-1.4-7-1.9c-18.2-3.6-30.2-15.1-39.2-30.5c-1.1-1.9-0.9-2.8,0.9-3.9
                                                c8.4-5.4,16.7-10.9,24.9-16.6c3.1-2.1,3.2,0.6,4.1,2.1c9.1,16,23.7,23.2,38.9,18.8c7.7-2.2,13.4-6.7,14.4-15.3
                                                c1.1-9.5-1.7-15-10.8-19.2c-13.3-6.1-27.1-11.1-40.1-17.6c-27.7-13.7-38.2-43.6-25-69.7c8.3-16.4,22.9-23.6,40.3-25.8
                                                c26.8-3.3,49.3,4.4,65.7,26.9c2.2,3,1.8,4.1-1.1,5.9c-7.3,4.6-14.6,9.3-21.6,14.3c-2.8,2-3.9,1.3-5.7-1.3
                                                c-7.8-11.3-18.3-17.2-32.4-15.4c-7.4,1-12.7,4.7-14.6,12.3c-1.9,7.6,1,13.6,7.2,17.7c11.2,7.4,24.4,10.3,36.8,15.1
                                                c31.6,12.1,45.9,41.1,34.4,71.2c-7.2,18.8-22.2,27.9-41,31.8c-1.1,0.2-2.1,0.7-3.1,1.1C1488.3,1485,1479.7,1485,1471,1485z"/>
                                            <path class="st0 zone-svg" d="M2280,1485c-1.4-1.9-3.6-1.4-5.4-1.8c-18.4-3.6-30.4-15.4-39.6-30.9c-1.5-2.6,0.4-3.1,1.8-4
                                                c7.7-5.2,15.6-10.2,23.3-15.5c2.8-2,3.7-1.4,5.2,1.5c8.4,15.7,23.3,22.9,38.5,18.8c8.8-2.3,13.9-7.8,15-16.1
                                                c1.1-8.3-1.9-14.2-10.7-18.3c-13.5-6.3-27.7-11.4-41-18c-28-14-38.2-46.7-22.8-72.2c8.6-14.2,22.1-20.7,38-22.8
                                                c27-3.6,49.6,4,66.4,26.5c2.3,3,2,4.3-1.2,6.3c-7.2,4.4-14.3,9.1-21.2,14.1c-2.9,2.1-4,1.5-6-1.3c-7.6-10.9-17.8-16.8-31.5-15.3
                                                c-7.6,0.8-13.2,4.4-15.4,12.1c-2,7.3,1,14.2,8.2,18.7c8.7,5.5,18.6,7.8,28.1,11.4c8.1,3.1,16.1,6.2,23.4,10.9
                                                c12.3,7.8,18.2,19.7,22,33c0,6,0,12,0,18c-2.8,16.1-10.6,28.8-25,37.1c-7.5,4.3-15.8,5.9-24,7.9C2297.3,1485,2288.7,1485,2280,1485
                                                z"/>
                                            <path class="st0 zone-svg" d="M1328,1485c-11.4-2.8-22.7-5.6-31.7-14c-5.7-5.3-10.1-11.4-14.3-17.9c-1.6-2.5-0.8-3.7,1.4-5
                                                c7.7-5,15.4-9.9,22.9-15.2c2.9-2.1,4-1.8,5.7,1.4c8.1,15.6,23,22.8,38.4,18.6c7.8-2.1,13.4-6.7,14.6-15.1c1.3-9.1-1.3-14.8-10.3-19
                                                c-12.1-5.7-24.8-10.4-37-15.9c-28.6-13-40.6-38.9-30.7-66.5c7-19.7,22.8-28.4,42.3-30.9c26.8-3.5,49.3,4.4,65.8,26.8
                                                c2.1,2.9,2,4.1-1.1,6c-7.3,4.6-14.5,9.4-21.6,14.3c-2.6,1.8-3.7,1.7-5.7-1.2c-7.8-11.5-18.5-17.5-32.8-15.4
                                                c-7.2,1.1-12.3,4.7-14.1,12.2c-1.8,7.4,0.8,13.2,6.7,17.4c8.8,6.3,19.4,8.5,29.2,12.4c6.6,2.6,13.4,4.8,19.6,8.5
                                                c20.2,11.9,29.2,31.3,25.6,55.6c-3,20.1-18.3,35.8-39.9,41c-2.3,0.6-4.6,1.3-7,2C1345.3,1485,1336.7,1485,1328,1485z"/>
                                            <path class="st0 zone-svg" d="M882,1485c-5.8-1.7-11.9-2.7-17.4-5.1c-17.6-7.7-27.9-21.4-29.8-40.5c-2.9-29.2-3.5-58.7-0.2-87.7
                                                c3.5-30.5,24.5-46.4,57.6-47.1c8.7-0.2,17.3,0.8,25.6,3.7c25.6,8.9,31.2,29.9,32.3,52.6c0.2,3.2-2.1,2.3-3.7,2.4
                                                c-10,0-20-0.1-30,0.1c-3.4,0.1-4.3-0.7-4.5-4.3c-0.5-14.8-7.3-22.8-18.9-22.8c-10.8,0-19.4,6.8-20,17.6
                                                c-1.4,27.3-1.6,54.6,0.1,81.9c0.7,10.7,7.5,16.3,18.6,17.2c9.3,0.8,16.5-4.4,19.3-14.4c1-3.7,2-7.6,1.8-11.3
                                                c-0.3-5.2,1.8-5.9,6.3-5.7c9.5,0.3,19,0.1,28.5,0.1c1.8,0,3.7-0.4,3.7,2.5c-0.2,18.1-2.9,35.2-17.7,47.9c-8.1,7-17.6,10.5-28,12.1
                                                c-0.9,0.1-2.1-0.4-2.5,1C896,1485,889,1485,882,1485z"/>
                                            <path class="st1 zone-svg" d="M400,0c1.7,27.2,3.3,54.4,5.1,81.6c0.2,3.5-0.4,5.2-4.2,6.2c-33.6,8.7-67.1,17.6-100.6,26.7
                                                c-3.8,1-5,0.1-5.4-3.6c-0.4-3.6-0.7-7.4-2.1-10.7c-4.7-11.2,0-18.2,8.2-25.8C331.3,46.3,364,21.6,399,0C399.3,0,399.7,0,400,0z"/>
                                            <path class="st2 zone-svg" d="M0,423c2.9-18.4,10.4-34.8,21.8-49.5c5.9-7.7,17-8.5,23-1.3c15.7,18.7,31.3,37.5,47.1,56.2
                                                c2.6,3,2.3,3.9-1.7,4.8c-28.6,6.6-57.2,13.5-85.8,20.3c-1.4,0.3-3,0.3-4.4,0.5C0,443.7,0,433.3,0,423z"/>
                                            <path class="st3 zone-svg" d="M2355,883c-2.8,7.6-8.7,8.2-15.9,8c-20.5-0.4-41-0.3-61.5-0.1c-4,0-5-1.2-4.9-5c0.2-16.5,0.1-33,0.1-50.3
                                                c4.1,2.3,7.7,4.2,11.2,6.2c22,12.4,44,24.9,66.1,37.2c1.5,0.8,2.8,2.5,4.9,1.9C2355,881.7,2355,882.3,2355,883z"/>
                                            <path class="st0 zone-svg" d="M2167.8,1339.6c-5.6,22.1-10.7,42.3-15.8,62.5c-6.2,24.7-12.5,49.3-18.5,74c-0.8,3.2-1.9,4.3-5.3,4.2
                                                c-7.3-0.4-16.5,2.3-21.4-1.2c-4.5-3.3-4.4-13-6.2-19.9c-10-38.6-19.9-77.2-29.9-115.8c-0.3-1.2-0.7-2.4-0.8-2.6
                                                c0,11.9,0,24.7,0,37.5c0,32.8,0,65.6,0.2,98.5c0,3-1,3.5-3.7,3.5c-8.5-0.2-17-0.2-25.5,0c-2.9,0.1-3.6-1-3.6-3.7
                                                c0.1-54.8,0.1-109.6,0-164.5c0-3,0.8-4,3.9-4c14.5,0.2,29,0.2,43.5,0c3.5-0.1,4.1,1.8,4.8,4.3c9.5,35,20.7,69.4,28.7,104.8
                                                c0.1,0.6,0.5,1.1,1.3,2.9c4.8-26.4,12.5-50.9,19.4-75.5c3.1-10.9,6.2-21.7,9.2-32.6c0.7-2.8,1.9-3.9,5-3.9c14.3,0.2,28.7,0.2,43,0
                                                c3.3,0,4.1,0.9,4.1,4.2c-0.1,54.7-0.1,109.3,0,164c0,3.4-1.1,4.1-4.2,4c-8.3-0.2-16.7-0.2-25,0c-3.3,0.1-4.1-0.8-4.1-4.1
                                                c0.5-44.1-0.9-88.3,1.5-132.4C2168.5,1343,2168.2,1342.3,2167.8,1339.6z"/>
                                            <path class="st1 zone-svg" d="M701.4,1369.5c1.4,35,0.1,69.9,0.7,104.8c0.1,4.8-1,6.3-5.9,6c-8.5-0.5-17-0.2-25.5-0.1
                                                c-2.9,0.1-3.6-0.9-3.6-3.7c0.1-54.8,0.1-109.6,0-164.4c0-3.6,1.4-4,4.4-4c8.8,0.2,17.7,0.3,26.5,0c4-0.1,6.2,1.1,8.1,4.7
                                                c16.9,32,35.8,62.9,50.7,94.3c0-9.4,0-20.1,0-30.9c-0.1-21.5-0.1-43-0.3-64.5c0-3,1.2-3.6,3.9-3.5c9.2,0.1,18.3,0.2,27.5,0
                                                c3.3-0.1,3.8,1.3,3.8,4.1c-0.1,54.6-0.1,109.3,0,163.9c0,3.4-1.1,4.2-4.3,4.1c-7.5-0.2-15-0.3-22.5,0c-3.5,0.1-5.3-1.1-6.9-4.2
                                                C739.4,1440.5,717.8,1406.4,701.4,1369.5z"/>
                                            <path class="st0 zone-svg" d="M1699,1480.2c-13.3,0-26.1-0.1-38.9,0c-3.1,0-3.3-2.3-4.1-4.2c-9.7-20.8-19.4-41.5-28.8-62.4
                                                c-3-6.5-8.3-3.3-12.4-3.4c-3.5,0-1.6,4-1.6,6c-0.2,20-0.2,40,0,60c0,2.9-0.5,4-3.8,4c-10-0.2-20-0.2-30,0c-3.1,0.1-3.9-0.9-3.9-3.9
                                                c0.1-54.6,0.1-109.3,0.1-163.9c0-1.7-1-4.3,2.5-4.2c25.4,0.7,51-1.8,76.3,1.8c23.5,3.3,37,16.7,39.6,38.2
                                                c3.4,28.4-5.6,45.6-28.9,54.7c-3.7,1.4-2.4,2.8-1.3,5c11.2,22.8,22.4,45.6,33.5,68.5C1697.8,1477.4,1698.3,1478.6,1699,1480.2z
                                                 M1613,1358.6c0,2.5,0,5,0,7.5c0,17.3,0,17.3,17.6,16.1c20.5-1.3,26.9-9.1,24.6-29.6c-1.2-10.2-6.4-15.7-16.6-16.6
                                                c-7.3-0.7-14.6-0.4-21.9-0.9c-3.3-0.2-3.8,1.1-3.8,4C1613.1,1345.6,1613,1352.1,1613,1358.6z"/>
                                            <path class="st1 zone-svg" d="M509.2,1393.8c0-27,0.1-54-0.1-81c0-3.6,0.7-4.8,4.6-4.8c35.5,0.2,71,0.1,106.4,0c3.6,0,5,0.8,4.8,4.6
                                                c-0.3,7.5-0.3,15,0,22.5c0.1,3.7-1,4.8-4.7,4.7c-23-0.2-46,0-69-0.2c-3.4,0-4.6,0.7-4.5,4.3c0.3,9.3,0.2,18.7,0,28
                                                c-0.1,3.3,0.9,4.2,4.2,4.1c15-0.2,30,0.1,45-0.2c3.8-0.1,4.8,1.1,4.7,4.8c-0.3,7.5-0.3,15,0,22.5c0.2,3.9-1.2,4.7-4.9,4.6
                                                c-14.8-0.2-29.7,0-44.5-0.2c-3.3,0-4.3,0.9-4.2,4.2c0.2,10.5,0.3,21,0,31.5c-0.1,3.8,1,4.7,4.7,4.7c24.7-0.2,49.3,0,74-0.2
                                                c3.4,0,4.6,0.6,4.5,4.3c-0.3,8-0.2,16,0,24c0.1,2.9-0.5,4.1-3.8,4c-37.8-0.1-75.6-0.1-113.4,0c-3.6,0-3.9-1.5-3.9-4.4
                                                C509.2,1448.5,509.2,1421.2,509.2,1393.8z"/>
                                            <path class="st4 zone-svg" d="M1281,835.4c0,17.7-0.1,35.3,0.1,53c0,3.3-0.9,4.2-4.2,4.2c-35-0.1-70-0.1-105,0c-3.3,0-4.2-0.9-4.2-4.2
                                                c0.2-35.6,0.2-71.3,0.2-106.9c0-2.8,0.7-3.7,3.6-3.7c35.3,0.1,70.6,0.1,106,0c3.5,0,3.6,1.6,3.6,4.2
                                                C1281,799.8,1281,817.6,1281,835.4z"/>
                                            <path class="st2 zone-svg" d="M1715.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.8,5.1c-0.1,34.3-0.2,68.6,0,103c0,4.6-1.4,5.5-5.6,5.4
                                                C1749.5,1013.5,1732.5,1013.7,1715.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M598.5,1013.7c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.7-5.1-4.9c0.2-34.7,0.2-69.3,0-104
                                                c0-3.9,1.3-4.6,4.9-4.6c34.5,0.1,69,0.1,103.5,0c4.1,0,4.9,1.4,4.9,5.1c-0.1,34.5-0.1,69,0,103.5c0,4.1-1.3,4.9-5.1,4.9
                                                C632.8,1013.6,615.7,1013.7,598.5,1013.7z"/>
                                            <path class="st2 zone-svg" d="M2027.1,956.9c0-17.3,0.1-34.7-0.1-52c0-3.6,0.8-4.9,4.7-4.9c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1,4.5,4.5
                                                c-0.1,34.8-0.1,69.7,0,104.5c0,3.9-1.3,4.7-4.9,4.7c-34.3-0.1-68.7-0.1-103,0c-4.2,0-5.4-1.2-5.3-5.3
                                                C2027.3,991.2,2027.1,974.1,2027.1,956.9z"/>
                                            <path class="st5 zone-svg" d="M606,783.5c-3.8,35.6-7.5,70.9-11.2,106.1c-0.3,2.9-1.4,3.5-4.1,3.2c-35.1-4-70.1-7.9-105.2-11.7
                                                c-2.3-0.3-3.6-0.5-3.3-3.4c3.9-35.4,7.8-70.8,11.5-106.2c0.3-3.1,1.2-3.8,4.2-3.5c34.7,3.9,69.5,7.7,104.2,11.5
                                                C604.9,779.9,607.2,780.2,606,783.5z"/>
                                            <path class="st2 zone-svg" d="M1101.9,532.3c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.9,0.9,4.8,4.7c-0.1,34.6-0.1,69.3,0,103.9
                                                c0,3.7-1,4.8-4.7,4.8c-33.6-0.1-67.3-0.2-101,0c-4.3,0-4.4-1.8-4.8-5.3c-4-34.4-2.4-68.8-2.8-103.3c0-4,1.2-5,5-5
                                                C1067.3,532.5,1084.6,532.3,1101.9,532.3z"/>
                                            <path class="st6 zone-svg" d="M735.1,335.5c0.4,3.2-2.6,2.9-4.4,3.4C699.1,347,667.6,355,636,363c-9.8,2.5-9.8,2.4-12.3-7.5
                                                c-8-31.4-15.9-62.8-24.1-94.2c-1.1-4.3-0.1-5.7,4.1-6.8c33.6-8.4,67-16.9,100.5-25.6c2.7-0.7,3.8-0.3,4.5,2.4
                                                c8.6,34.2,17.4,68.3,26.1,102.5C734.9,334.4,735,334.9,735.1,335.5z"/>
                                            <path class="st6 zone-svg" d="M2140.1,343.5c0,17.3-0.1,34.7,0.1,52c0,3.4-0.8,4.6-4.4,4.6c-34.8-0.1-69.7-0.1-104.5,0
                                                c-3.4,0-4.2-1.1-4.2-4.3c0.1-34.8,0.1-69.7,0-104.5c0-3.2,0.8-4.3,4.2-4.3c34.8,0.1,69.7,0.1,104.5,0c3.6,0,4.5,1.2,4.4,4.6
                                                C2140,308.8,2140.1,326.2,2140.1,343.5z"/>
                                            <path class="st7 zone-svg" d="M2263,343.5c0,17.5-0.1,35,0.1,52.4c0,3.3-0.9,4.1-4.2,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-1-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.1C2262.9,308.5,2263,326,2263,343.5z"
                                                />
                                            <path class="st7 zone-svg" d="M1101.5,409.8c17.3,0,34.7,0.1,52-0.1c3.6,0,4.8,0.8,4.8,4.6c-0.2,34.7-0.1,69.3,0,104c0,3.4-0.7,4.6-4.4,4.6
                                                c-34.8-0.1-69.7-0.1-104.5,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.8,1.4-4.3,4.6-4.2
                                                C1066.8,409.9,1084.2,409.8,1101.5,409.8z"/>
                                            <path class="st4 zone-svg" d="M1281,466.5c0,17.3-0.1,34.6,0.1,52c0,3.4-0.7,4.5-4.3,4.5c-34.8-0.1-69.6-0.2-104.4,0c-4,0-4.6-1.3-4.6-4.8
                                                c0.1-34.6,0.1-69.3,0-103.9c0-3.5,0.9-4.4,4.4-4.4c34.8,0.1,69.6,0.2,104.4,0c4,0,4.5,1.3,4.5,4.8
                                                C1280.9,431.8,1281,449.2,1281,466.5z"/>
                                            <path class="st6 zone-svg" d="M1592,522.9c-17,0-34-0.1-50.9,0.1c-4,0-5-1.1-5-5.1c0.1-34.5,0.1-68.9,0-103.4c0-3.6,1-4.9,4.8-4.9
                                                c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,1.1,4.5,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.9-4.8,4.8
                                                C1626.9,522.8,1609.5,522.9,1592,522.9z"/>
                                            <path class="st7 zone-svg" d="M1715.5,522.8c-17.3,0-34.6-0.1-52,0.1c-3.8,0-4.7-1.1-4.6-4.8c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.6,0.7-4.8,4.6-4.8c34.6,0.2,69.3,0.2,103.9,0c3.8,0,4.7,1.1,4.6,4.8c-0.1,34.6-0.2,69.3,0,103.9c0,4.3-1.5,4.8-5.1,4.8
                                                C1749.8,522.8,1732.7,522.8,1715.5,522.8z"/>
                                            <path class="st7 zone-svg" d="M1281,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-4-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.2,1-3.8,4-3.8c35,0.1,70,0.1,105,0c3.8,0,4.2,1.4,4.2,4.6C1280.9,677,1281,694.5,1281,712z"/>
                                            <path class="st5 zone-svg" d="M1536.2,711c0-17.1,0.1-34.3-0.1-51.4c0-3.2,0.3-4.6,4.2-4.6c35,0.2,69.9,0.1,104.9,0c3.3,0,4.1,0.9,4.1,4.2
                                                c-0.1,35-0.1,69.9,0,104.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.2-0.9-4.1-4.2
                                                C1536.2,746.3,1536.2,728.6,1536.2,711z"/>
                                            <path class="st6 zone-svg" d="M1715.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.9-4.8-4.7c0.1-34.7,0.1-69.3,0-104
                                                c0-3.6,1.2-4.5,4.6-4.4c34.7,0.1,69.3,0.1,104,0c3.4,0,4.6,0.8,4.6,4.4c-0.1,34.7-0.1,69.3,0,104c0,3.8-1.2,4.7-4.8,4.7
                                                C1749.9,890.8,1732.6,890.9,1715.3,890.9z"/>
                                            <path class="st6 zone-svg" d="M1045,834.5c0-17.3,0.1-34.6-0.1-52c0-3.8,1.1-4.7,4.8-4.7c34.5,0.1,68.9,0.1,103.4,0c3.9,0,5.1,1,5.1,5
                                                c-0.1,34.5-0.1,68.9,0,103.4c0,3.8-1.2,4.7-4.8,4.7c-34.6-0.1-69.3-0.1-103.9,0c-3.5,0-4.5-1-4.5-4.5
                                                C1045.1,869.1,1045,851.8,1045,834.5z"/>
                                            <path class="st8 zone-svg" d="M1592.6,777.8c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.9,4.2,4.1c-0.1,35-0.1,69.9,0,104.9c0,3.4-1.1,4.1-4.3,4.1
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-0.9-4.5-4.4c0.1-34.8,0.1-69.6,0-104.4c0-3.7,1.3-4.3,4.6-4.3
                                                C1558,777.9,1575.3,777.8,1592.6,777.8z"/>
                                            <path class="st6 zone-svg" d="M922.1,343.5c0-17.2,0.1-34.3-0.1-51.5c0-3.8,0.8-5.2,4.9-5.2c34.5,0.2,68.9,0.2,103.4,0c4,0,5,1.3,5,5.1
                                                c-0.1,34.3-0.1,68.6,0,102.9c0,3.8-0.8,5.2-4.9,5.1c-34.5-0.2-68.9-0.2-103.4,0c-4.1,0-5-1.3-4.9-5.1
                                                C922.2,377.8,922.1,360.7,922.1,343.5z"/>
                                            <path class="st4 zone-svg" d="M1894.8,343.5c0,17.3-0.1,34.7,0.1,52c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-105,0c-3,0-4-0.7-3.9-3.8
                                                c0.1-35.2,0.1-70.3,0-105.5c0-3.1,0.9-3.8,3.9-3.8c35,0.1,70,0.1,105,0c3.8,0,4.3,1.3,4.2,4.6
                                                C1894.8,308.8,1894.8,326.2,1894.8,343.5z"/>
                                            <path class="st9 zone-svg" d="M1715.5,400c-17.5,0-35-0.1-52.5,0.1c-3.3,0-4.1-0.8-4.1-4.1c0.1-35,0.1-70,0-104.9c0-3.3,0.8-4.1,4.1-4.1
                                                c35,0.1,70,0.1,104.9,0c3.3,0,4.1,0.8,4.1,4.1c-0.1,35-0.1,70,0,104.9c0,3.3-0.8,4.1-4.1,4.1C1750.5,399.9,1733,400,1715.5,400z"/>
                                            <path class="st5 zone-svg" d="M887.2,344c0,17.3-0.1,34.6,0.1,51.9c0,3.3-0.9,4.1-4.1,4.1c-35-0.1-69.9-0.1-104.9,0c-3.3,0-4.1-0.9-4.1-4.2
                                                c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.4,0,4.1,1,4.1,4.2C887.1,308.7,887.2,326.4,887.2,344z"/>
                                            <path class="st10 zone-svg" d="M1101.5,400c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-5.2-0.5-5.2-4.8c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.5,0.9-4.5,4.4-4.4c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.1,4.4,4.5c-0.1,34.6-0.1,69.3,0,103.9c0,3.7-1,4.7-4.7,4.7
                                                C1136.2,399.9,1118.8,400,1101.5,400z"/>
                                            <path class="st2 zone-svg" d="M916.6,160.6c-4,30.5-8,61-12.1,91.5c-0.4,2.8-1.3,5.6-1.1,8.4c0.8,9.1-3.8,9.2-11,8.2
                                                c-31.8-4.5-63.6-8.6-95.5-12.7c-4.8-0.6-6.9-1.4-6.1-7.3c4.8-33.8,9.1-67.6,13.4-101.4c0.5-3.8,1.9-4.2,5.5-3.7
                                                c34.1,4.6,68.3,9,102.4,13.5C914.1,157.4,917.3,156.7,916.6,160.6z"/>
                                            <path class="st10 zone-svg" d="M395.9,718.1c-24.6,2.4-49.3,4.7-73.9,7.2c-3.3,0.3-4.7-0.3-5-4c-3.3-34.7-6.8-69.5-10.4-104.2
                                                c-0.3-3.2,0.3-3.9,3.4-4.2c35.1-3.5,70.1-7,105.2-10.7c2.8-0.3,3.7,0.4,4,3.3c2.2,23.2,4.6,46.3,7,69.5c1.2,11.5,2.2,23,3.6,34.5
                                                c0.4,3.6,0.3,5.4-4.2,5.6C415.6,715.7,405.8,717.1,395.9,718.1z"/>
                                            <path class="st0 zone-svg" d="M1244.6,1479.9c-6,0-13.6,2.2-17.5-0.6c-3.8-2.8-3.7-10.8-5.2-16.5c-4.2-16.5-4.2-16.5-21.5-16.5
                                                c-10.3,0-20.7,0.2-31-0.1c-3.4-0.1-4.6,1.2-5.3,4.2c-2.2,8.9-4.7,17.7-6.8,26.6c-0.6,2.7-1.6,3.5-4.3,3.4c-10-0.1-20-0.2-30,0
                                                c-3.2,0.1-3.5-1-2.8-3.8c15.6-55,31.1-110,46.6-165c0.7-2.6,1.8-3.4,4.4-3.4c13,0.1,26,0.1,39,0c2.7,0,3.8,0.9,4.5,3.4
                                                c15.8,55.1,31.7,110.1,47.7,165.2c0.9,3.2,0,3.7-2.8,3.6c-5-0.2-10,0-15,0C1244.6,1480.1,1244.6,1480,1244.6,1479.9z
                                                 M1190.9,1337.8c-6.4,26.8-12.3,51.4-18.3,75.8c-0.8,3.1,0.3,3.3,2.8,3.2c7-0.1,14,0,21,0c13.9,0,13.9,0,10.6-13.4
                                                C1201.8,1382.3,1196.6,1361.3,1190.9,1337.8z"/>
                                            <path class="st7 zone-svg" d="M507.7,489.2c-4.8,1.9-5.7-1.1-6.2-6.1c-3-33.7-6.2-67.3-9.6-100.9c-0.4-4.2,0.9-5.1,4.9-5.5
                                                c33.5-3,67-6.2,100.4-9.6c5.1-0.5,7.2,0.3,7.7,5.9c2.9,33.8,6.1,67.7,9.3,101.5c0.4,3.7-0.4,4.8-4.1,5.2
                                                C576.3,482.6,542.5,485.9,507.7,489.2z"/>
                                            <path class="st7 zone-svg" d="M2150,957c0-17.5,0.1-35-0.1-52.5c0-3.5,0.9-4.5,4.4-4.4c34.7,0.1,69.3,0.1,104,0c3.6,0,4.8,0.7,4.8,4.6
                                                c-0.2,31.8-0.1,63.6-0.1,95.5c0,4.9-8.2,13.3-13.3,13.3c-32,0-64,0-96,0.1c-3.8,0-3.8-1.8-3.8-4.6C2150,991.7,2150,974.3,2150,957z
                                                "/>
                                            <path class="st4 zone-svg" d="M1158.2,712c0,17.2-0.1,34.3,0.1,51.5c0,3.2-0.4,4.6-4.2,4.6c-35-0.2-70-0.1-104.9,0c-3.2,0-4.2-0.6-4.2-4
                                                c0.2-25.7-0.2-51.3,0.2-77c0.1-9.8,1.7-19.5,2.5-29.3c0.2-2.5,1.5-2.8,3.6-2.8c34.5,0,69,0.1,103.4,0c3.4,0,3.6,1.4,3.6,4.1
                                                C1158.1,676.7,1158.2,694.4,1158.2,712z"/>
                                            <path class="st4 zone-svg" d="M1649.2,589c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.7,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0c-4.1,0-4.9-1.3-4.9-5.1
                                                c0.1-34.3,0.1-68.6,0-103c0-3.8,0.9-5.1,4.9-5.1c34.5,0.2,69,0.2,103.5,0c4.2,0,4.8,1.5,4.8,5.1
                                                C1649.1,554.7,1649.2,571.9,1649.2,589z"/>
                                            <path class="st7 zone-svg" d="M1838,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.6,0-4.9-0.7-4.8-4.6c0.2-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.8,0.1,69.6,0.1,104.4,0c3.6,0,4.4,1.3,4.4,4.6c-0.1,34.6-0.1,69.3,0,103.9c0,4-1.6,4.6-5,4.5
                                                C1872.6,1013.4,1855.3,1013.4,1838,1013.4z"/>
                                            <path class="st6 zone-svg" d="M1224.6,645.2c-17.3,0-34.7-0.1-52,0.1c-3.7,0-4.8-1.1-4.8-4.8c0.1-34.3,0.1-68.6,0-103c0-3.7,1-4.9,4.8-4.8
                                                c34.7,0.1,69.3,0.1,104,0c3.5,0,4.5,1.1,4.5,4.5c-0.1,34.5-0.1,69,0,103.5c0,4-1.5,4.6-5,4.6
                                                C1258.9,645.2,1241.8,645.2,1224.6,645.2z"/>
                                            <path class="st9 zone-svg" d="M1158.2,957.5c0,17.2-0.1,34.3,0.1,51.5c0,3.3-0.5,4.6-4.2,4.6c-35-0.1-69.9-0.1-104.9,0
                                                c-3.3,0-4.2-0.8-4.1-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1-4.1,4.2-4.1c35,0.1,69.9,0.1,104.9,0c3.8,0,4.2,1.4,4.2,4.6
                                                C1158.1,922.5,1158.2,940,1158.2,957.5z"/>
                                            <path class="st7 zone-svg" d="M733.1,1013.4c-17.1,0-34.3-0.1-51.4,0.1c-3.5,0-4.9-0.6-4.9-4.6c0.2-34.6,0.2-69.3,0-103.9
                                                c0-3.9,1.3-4.6,4.8-4.6c34.5,0.1,68.9,0.1,103.4,0c4,0,5,1.2,5,5.1c-0.1,34.3-0.2,68.6,0,102.9c0,4.4-1.5,5.1-5.4,5.1
                                                C767.4,1013.3,750.2,1013.4,733.1,1013.4z"/>
                                            <path class="st4 zone-svg" d="M922.2,956.5c0-17.2,0.1-34.3-0.1-51.5c0-3.4,0.8-4.6,4.4-4.6c34.8,0.1,69.6,0.1,104.4,0
                                                c3.3,0,4.7,0.6,4.6,4.3c-0.1,34.8-0.1,69.6,0,104.4c0,3.1-0.7,4.3-4.1,4.3c-35-0.1-70-0.1-104.9,0c-3.6,0-4.4-1.2-4.4-4.6
                                                C922.2,991.5,922.2,974,922.2,956.5z"/>
                                            <path class="st10 zone-svg" d="M1960.8,400c-17.1,0-34.3-0.1-51.4,0.1c-3.7,0-4.8-0.9-4.8-4.7c0.1-34.6,0.1-69.3,0-103.9
                                                c0-3.4,0.8-4.6,4.4-4.5c34.6,0.1,69.3,0.1,103.9,0c3.5,0,4.5,0.9,4.5,4.5c-0.1,34.8-0.1,69.6,0,104.4c0,3.8-1.5,4.3-4.7,4.3
                                                C1995.4,399.9,1978.1,400,1960.8,400z"/>
                                            <path class="st6 zone-svg" d="M2017.2,956.8c0,17.2-0.1,34.3,0.1,51.5c0,4-1.2,5.1-5.1,5.1c-34.1-0.1-68.3-0.1-102.4,0
                                                c-3.9,0-5.1-1.1-5.1-5.1c0.1-34.5,0.1-69,0-103.4c0-3.8,1.2-4.8,4.8-4.8c34.3,0.1,68.6,0.1,102.9,0c3.7,0,4.9,1,4.8,4.8
                                                C2017.1,922.1,2017.2,939.5,2017.2,956.8z"/>
                                            <path class="st7 zone-svg" d="M2017.2,166.1c0.1,36,0.2,71.9,0.3,107.9c0,2.5-1,3-3.3,3c-35.5-0.1-70.9-0.1-106.4,0c-2.7,0-3.3-1-3.3-3.5
                                                c0.1-35.3,0.1-70.6,0-105.9c0-2.8,0.7-3.7,3.6-3.7c32.6,0.2,65.3,0.2,97.9,0.3C2009.8,164.8,2013.5,165.5,2017.2,166.1z"/>
                                            <path class="st6 zone-svg" d="M912.2,957.5c0,17-0.1,34,0.1,51c0,3.7-1.1,4.8-4.8,4.8c-34.3-0.1-68.6-0.1-103,0c-3.7,0-4.8-1.1-4.8-4.8
                                                c0.1-34.3,0.1-68.6,0-103c0-3.7,1.1-4.8,4.8-4.8c34.3,0.1,68.6,0.1,103,0c3.7,0,4.9,1.1,4.8,4.8
                                                C912.1,922.9,912.2,940.2,912.2,957.5z"/>
                                            <path class="st1 zone-svg" d="M354.5,1394.1c0-27,0.1-54-0.1-80.9c0-3.7,0.7-5.2,4.9-5.1c24.4,0.9,49-1.9,73.3,1.9
                                                c28.2,4.4,43.5,24.2,42.6,54c-0.9,28.4-18,47.3-45.6,50c-10.7,1.1-21.6,1.4-32.4,1.7c-3.6,0.1-4.4,1.1-4.4,4.5
                                                c0.1,18.5,0,37,0.1,55.5c0,3.4-0.8,4.6-4.4,4.5c-9.8-0.2-19.7-0.3-29.5,0c-3.8,0.1-4.7-1-4.7-4.7
                                                C354.5,1448.4,354.5,1421.2,354.5,1394.1z M392.8,1361.8c0,7.3,0.1,14.6,0,22c0,2.2,0.3,3.4,2.9,3.3c7.3-0.4,14.7-0.2,21.9-1.1
                                                c10.8-1.3,17.5-10.6,17.9-23.5c0.5-15.1-4.1-22.1-16.2-24.6c-7.4-1.5-14.9-0.6-22.4-1c-3.2-0.2-4.3,0.7-4.2,4.1
                                                C393,1347.8,392.8,1354.8,392.8,1361.8z"/>
                                            <path class="st8 zone-svg" d="M856.3,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.6,0,4.8,0.8,4.8,4.7c-0.1,33-0.2,66,0,98.9c0,3.9-1.2,5-5,5.4
                                                c-34.2,3.3-68.4,3.6-102.7,1c-4.4-0.3-5.5-1.7-5.5-6c0.2-32.8,0.2-65.6,0-98.4c0-4.8,1.6-5.7,5.9-5.6
                                                C822.3,1023.3,839.3,1023.2,856.3,1023.2z"/>
                                            <path class="st5 zone-svg" d="M302.1,387.8c27.6,2.8,55.3,5.6,82.9,8.2c2.9,0.3,3.1,1.6,2.8,3.9c-3.7,34.7-7.5,69.4-11.1,104.2
                                                c-0.3,3.2-1.4,4.1-4.6,3.8c-35.1-3.7-70.1-7.4-105.2-10.9c-3.9-0.4-3-2.6-2.8-4.8c3.2-29.6,6.4-59.2,9.5-88.8
                                                c0.3-2.5,0.4-5,0.6-7.5c4.2,0.9,8.4,1.8,12.6,2.7C300.8,401.9,300.8,401.9,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M673.1,564.8c-2.8,18.3-3.6,36.9-2.1,55.6c1,12,0.7,12-11.4,13.5c-28.9,3.6-57.8,7.3-86.7,10.9
                                                c-2,0.3-3.6,0.8-4-2.5c-4.4-35.5-8.9-71-13.5-106.5c-0.6-4.3,2.7-3.2,4.5-3.4c22.1-2.9,44.2-5.6,66.4-8.4c12-1.5,24.1-2.9,36.1-4.7
                                                c3.7-0.5,5.3,0.1,5.7,4.2C669.5,537.2,671.3,550.9,673.1,564.8z"/>
                                            <path class="st5 zone-svg" d="M1894.8,220.4c0,17.5-0.1,35,0.1,52.5c0,3.2-0.7,4.2-4.1,4.2c-35-0.1-70-0.1-104.9,0c-3.3,0-4.1-0.8-4.1-4.1
                                                c0.1-30.3,0.1-60.6,0-90.9c0-3.1,1.1-4.2,3.9-5c34.5-9.4,69.5-15.3,105.5-13.1c3.2,0.2,3.8,1.2,3.8,4
                                                C1894.8,185.4,1894.8,202.9,1894.8,220.4z"/>
                                            <path class="st2 zone-svg" d="M553,709.5c0-16.3,0-32.6,0-48.9c0-2.6-0.3-4.6,3.7-4.7c31.8-0.5,63.5-1.1,95.3-1.9c4.2-0.1,5.1,1.2,5.3,5.2
                                                c0.8,13.1,2.1,26.3,6.2,38.8c4.8,14.7,3.1,29.6,3.8,44.5c0.4,6.6,0.3,13.3,0.6,19.9c0.1,2.8-0.8,3.7-3.7,3.8
                                                c-34.9,0.6-69.9,1.2-104.8,2c-3.8,0.1-4.7-1.2-4.7-4.8c0.2-18,0.1-35.9,0.1-53.9C554.2,709.5,553.6,709.5,553,709.5z"/>
                                            <path class="st4 zone-svg" d="M1961.5,1023.2c17.2,0,34.3,0.1,51.5-0.1c3.4,0,4.6,0.8,4.6,4.4c-0.1,31.6-0.1,63.3,0,94.9
                                                c0,3.2-1.2,4.2-4.2,4.7c-34.4,5.4-69.1,7.8-103.9,7.9c-4,0-5-1.2-5-5.1c0.1-34,0.2-67.9,0-101.9c0-4.1,1.3-4.9,5.1-4.9
                                                C1926.9,1023.3,1944.2,1023.2,1961.5,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1838,1023.1c17.5,0,35,0.1,52.5-0.1c3.5,0,4.5,1,4.5,4.5c-0.1,34.1-0.1,68.3,0,102.4c0,2.7-0.3,4.3-3.7,4.2
                                                c-36-1.3-71.5-6.8-106.4-15.7c-2.5-0.6-3-1.9-3-4.2c0.1-29.1,0.1-58.3,0-87.4c0-3.9,2.1-3.7,4.7-3.7
                                                C1803.7,1023.2,1820.8,1023.1,1838,1023.1z"/>
                                            <path class="st8 zone-svg" d="M2140.2,834.3c0,17.2-0.1,34.3,0.1,51.5c0,3.7-0.6,5.1-4.8,5.1c-34.5-0.2-69-0.2-103.5,0
                                                c-4.1,0-4.9-1.3-4.9-5.1c0.2-20.2,0.1-40.3,0-60.5c0-2.7,0.5-4.6,2.8-6.3c14.1-10.6,26.2-23.2,36.8-37.1c2.4-3.1,4.8-4.2,8.7-4.2
                                                c19.8,0.2,39.7,0.2,59.5,0c4,0,5.4,0.8,5.3,5.1C2140,800,2140.2,817.2,2140.2,834.3z"/>
                                            <path class="st7 zone-svg" d="M684.1,146c-20.8-3.8-41.4-7.6-62-11.4c-13.9-2.6-27.8-5.2-41.7-7.6c-3.7-0.6-5-1.8-4.2-5.7
                                                c5-26.3,9.9-52.6,14.6-79c0.5-2.9,1.5-4.1,4.6-4.5c32.7-4.7,65.7-5.7,98.7-4.7c12.8,0.4,13.2,0.8,10.9,13.2
                                                c-5.8,31.9-11.7,63.8-17.6,95.7C687,143.9,687.6,146.9,684.1,146z"/>
                                            <path class="st4 zone-svg" d="M1649.2,343.7c0,17.3-0.1,34.7,0.1,52c0,3.5-0.9,4.4-4.4,4.4c-34.8-0.1-69.6-0.1-104.4,0
                                                c-3.7,0-4.4-1.1-4.3-4.5c0.2-18.5,0.1-37,0-55.5c0-2.4,0.5-4.4,2.1-6.4c13.2-15.7,27.3-30.5,42.3-44.5c1.6-1.5,3.3-2.4,5.7-2.4
                                                c19.7,0.1,39.3,0.2,59,0c3.6,0,4,1.3,3.9,4.3C1649.1,308.7,1649.2,326.2,1649.2,343.7z"/>
                                            <path class="st8 zone-svg" d="M979,277c-17.5,0-35-0.1-52.5,0.1c-3.5,0-4.5-0.9-4.4-4.4c0.1-34.8,0.1-69.7,0-104.5c0-3.7,1.3-4.5,4.6-4.2
                                                c25.3,2.3,49.9,7.9,74.3,14.5c10.4,2.8,20.6,6.4,31,9.4c2.8,0.8,3.6,2.1,3.6,4.9c-0.1,26.7-0.1,53.3,0,80c0,3.7-1.3,4.3-4.6,4.3
                                                C1013.7,276.9,996.3,277,979,277z"/>
                                            <path class="st8 zone-svg" d="M2140.2,466.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.7-4.8,4.6c-19.7-0.2-39.3-0.2-59,0c-3.2,0-5-0.9-6.9-3.6
                                                c-11.3-16.4-24.3-31.3-40.1-43.6c-1.7-1.3-2.5-2.8-2.5-5c0.1-19,0.1-38,0-57c0-3.2,0.8-4.3,4.2-4.3c35,0.1,70,0.1,105,0
                                                c3.5,0,4,1.3,4,4.4C2140.1,431.3,2140.2,448.8,2140.2,466.3z"/>
                                            <path class="st7 zone-svg" d="M1593.1,900.6c17.2,0,34.3,0.1,51.5-0.1c3.8,0,4.7,1.1,4.7,4.8c-0.1,34.5-0.1,69,0,103.5
                                                c0,3.6-0.7,4.9-4.6,4.8c-18.2-0.2-36.3-0.1-54.5-0.1c-2.4,0-4.4-0.5-6.3-2.2c-16.1-14.5-31.1-30.1-45.1-46.6c-1.7-2-2.6-4-2.6-6.7
                                                c0.1-17.7,0.2-35.3,0-53c0-3.5,1-4.5,4.5-4.5C1558.1,900.6,1575.6,900.6,1593.1,900.6z"/>
                                            <path class="st5 zone-svg" d="M789.8,1077.5c0,16.5-0.1,33,0.1,49.5c0,3.7-1.2,4.5-4.5,4.1c-35.9-4.4-71.1-11.9-105.6-23.1
                                                c-2.3-0.7-3-1.8-3-4.2c0.1-25.7,0.1-51.3,0-77c0-2.9,0.8-3.6,3.7-3.6c35.2,0.1,70.3,0.1,105.5,0c3.6,0,4,1.4,4,4.4
                                                C789.8,1044.1,789.8,1060.8,789.8,1077.5z"/>
                                            <path class="st5 zone-svg" d="M979.1,1023.2c17.3,0,34.7,0.1,52-0.1c3.5,0,4.5,0.9,4.5,4.4c-0.1,24-0.1,48,0,72c0,3.1-1.1,4.4-3.8,5.3
                                                c-34.4,11.8-69.6,20.1-105.6,25.1c-2.9,0.4-4.1-0.1-4.1-3.4c0.1-33.2,0.1-66.3,0-99.5c0-3.8,1.7-3.8,4.5-3.8
                                                C944.1,1023.2,961.6,1023.2,979.1,1023.2z"/>
                                            <path class="st10 zone-svg" d="M1715.6,768c-17.5,0-35-0.1-52.5,0.1c-3.2,0-4.3-0.8-4.2-4.1c0.1-35,0.1-69.9,0-104.9c0-3.4,1.1-4.1,4.3-4.1
                                                c26.1,0.1,52.3,0.1,78.4,0c3.1,0,4.3,0.7,4.4,4.1c1.3,35.3,8.9,69.2,24.8,100.9c3,6,1.7,8.1-4.8,8.1
                                                C1749.3,768,1732.4,768,1715.6,768z"/>
                                            <path class="st2 zone-svg" d="M1526.7,711.9c0,17.2-0.1,34.3,0.1,51.5c0,3.7-1,4.8-4.8,4.7c-25.7-0.2-51.3-0.1-77,0c-3.3,0-4.5-0.9-5.2-4.2
                                                c-7.8-34.2-11.3-68.9-12.5-103.9c-0.1-3.9,1-5,5-5c29.8,0.2,59.6,0.2,89.5,0c3.9,0,5.1,1,5,5
                                                C1526.5,677.2,1526.7,694.5,1526.7,711.9z"/>
                                            <path class="st6 zone-svg" d="M1715.3,532.8c17.2,0,34.3,0.1,51.5-0.1c3.7,0,4.8,0.6,2.9,4.4c-15.9,32.7-23.8,67.2-23.7,103.6
                                                c0,3.4-1,4.6-4.5,4.6c-26-0.1-52-0.1-78,0c-3.4,0-4.6-0.9-4.6-4.5c0.1-34.5,0.1-69,0-103.4c0-3.9,1.3-4.7,4.9-4.7
                                                C1681,532.9,1698.1,532.8,1715.3,532.8z"/>
                                            <path class="st2 zone-svg" d="M2083.4,277c-17.2,0-34.3-0.1-51.5,0.1c-3.6,0-4.9-0.7-4.9-4.6c0.2-33.3,0.1-66.6,0-99.9
                                                c0-3.4,0.4-4.5,4.3-3.8c36.2,7,71.2,17.8,104.9,32.9c2.9,1.3,3.9,2.8,3.9,5.9c-0.1,21.5-0.2,43,0,64.5c0,4.4-1.5,5.1-5.4,5.1
                                                C2117.7,276.9,2100.5,277,2083.4,277z"/>
                                            <path class="st7 zone-svg" d="M1526.4,589.5c0,17.2-0.1,34.3,0.1,51.5c0,3.5-1,4.5-4.5,4.5c-30-0.1-60-0.1-90,0c-3.4,0-4.6-0.8-4.6-4.4
                                                c0.2-35.4,4.4-70.4,11.8-105c0.6-2.8,1.9-3.6,4.8-3.6c26,0.1,52,0.1,78,0c3.5,0,4.5,1.1,4.5,4.5
                                                C1526.4,554.5,1526.4,572,1526.4,589.5z"/>
                                            <path class="st2 zone-svg" d="M2206.3,890.9c-17.2,0-34.3-0.1-51.5,0.1c-4,0.1-5-1.2-4.9-5c0.1-34.3,0.2-68.7,0-103c0-4.3,1.3-4.9,5.3-5.2
                                                c10.5-0.8,19.6,2,28.7,7.4c24.6,14.6,49.7,28.4,74.7,42.3c3.1,1.7,4.5,3.6,4.4,7.3c-0.2,17.2-0.2,34.3,0,51.5c0,3.7-1,4.8-4.7,4.7
                                                C2241,890.8,2223.7,890.9,2206.3,890.9z"/>
                                            <path class="st2 zone-svg" d="M302.1,387.8c-1.3,14.1-1.3,14.1-15.2,10.9c-4.2-1-8.4-1.8-12.6-2.7c-32.5-7.7-65-15.6-97.5-22.9
                                                c-7.5-1.7-8.2-3.6-4.8-10.3c10.7-20.5,20.6-41.4,30.7-62.2c1.5-3.1,3-3.8,6.5-3c31,6.7,62.1,13.1,93.2,19.5
                                                c3.7,0.8,5.2,1.9,4.9,6.1C305.3,344.7,303.8,366.3,302.1,387.8z"/>
                                            <path class="st5 zone-svg" d="M2083.5,1023.2c17.5,0,35,0.1,52.5-0.1c3.2,0,4.3,0.7,4.2,4.1c-0.2,19.3-0.1,38.7,0,58c0,2.4-0.5,3.8-3,4.9
                                                c-34.1,15.5-69.6,26.3-106.1,33.8c-3,0.6-4-0.1-4-3.4c0.1-31.2,0.1-62.3,0-93.5c0-3.7,1.5-3.9,4.5-3.9
                                                C2048.9,1023.2,2066.2,1023.2,2083.5,1023.2z"/>
                                            <path class="st5 zone-svg" d="M461.8,1006.1c-19.2-3-37.7-7.2-55.9-12.3c-14.5-4.1-28.7-9.3-43-14.3c-8.4-3-14.3-7.6-18.7-15.6
                                                c-7.2-13.3-7.7-13,5.4-21c26.5-16.2,53.1-32.3,79.6-48.6c3.1-1.9,4.4-1.7,6.4,1.5c17.9,29.7,36,59.4,54.2,89
                                                c1.7,2.8,1.9,4.3-1.2,6.1c-7.8,4.5-15.4,9.3-23,13.9C464.2,1005.5,463,1006.5,461.8,1006.1z"/>
                                            <path class="st9 zone-svg" d="M1224.3,400c-17.3,0-34.7-0.1-52,0.1c-3.9,0.1-4.6-1.1-4.6-4.7c0.1-34.7,0.1-69.3,0-104c0-3.3,0.5-4.9,4.3-4.5
                                                c3.3,0.3,6.7,0.6,10,0c15.8-2.8,27.1,3.8,37.8,15.1c17.6,18.7,34.7,37.7,50.6,57.9c7.8,9.9,12,19.9,10.9,32.7
                                                c-0.5,5.8-1.2,7.7-7.5,7.5C1257.3,399.6,1240.8,400,1224.3,400z"/>
                                            <path class="st2 zone-svg" d="M1035.4,834.6c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.8,4.9-4.7,4.9c-34.7-0.1-69.3-0.1-104,0
                                                c-3.2,0-4.8-0.5-4.7-4.3c0.2-12.3,0.2-24.7,0-37c0-2.8,0.9-4.1,3.4-5.2c33.2-13.3,60-34.8,81-63.6c1.7-2.3,3.5-3.2,6.2-3
                                                c7.3,0.3,16.9-2.4,21.3,1.3c4.5,3.8,1.2,13.7,1.3,21C1035.5,811.6,1035.4,823.1,1035.4,834.6z"/>
                                            <path class="st5 zone-svg" d="M572.9,208c-30.2,30.3-60,60.3-89.8,90.3c-4.2,4.3-8.5,8.4-12.7,12.7c-1.9,2-2.7,2.3-3.9-0.6
                                                c-10.4-25-20.9-49.9-31.5-74.8c-0.9-2.2-0.8-3.5,0.9-5.2c17-16.4,33.9-33,50.8-49.5c1.2-1.2,2.1-2.3,4.2-1.5
                                                C518.1,189,545.4,198.4,572.9,208z"/>
                                            <path class="st0 zone-svg" d="M987.8,1394.4c0-27.1,0.1-54.3-0.1-81.4c0-4,1.2-5,5-4.9c9.7,0.3,19.3,0.3,29,0c4.1-0.1,4.9,1.3,4.9,5.1
                                                c-0.1,43.1,0,86.3-0.2,129.4c0,4.8,1.4,5.6,5.8,5.6c21.6-0.2,43.3,0,65-0.2c3.7,0,5.2,0.6,5,4.7c-0.4,8-0.2,16,0,24
                                                c0.1,2.8-0.7,3.6-3.6,3.6c-35.6-0.1-71.3-0.1-106.9,0c-3.8,0-3.8-1.6-3.8-4.4C987.9,1448.7,987.8,1421.5,987.8,1394.4z"/>
                                            <path class="st2 zone-svg" d="M1167.9,956.9c0-17.2,0.1-34.3-0.1-51.5c0-3.7,0.7-5.2,4.9-5.2c34.5,0.1,69,0,103.4-0.2c3.9,0,4.8,1,5.1,4.9
                                                c0.5,7.4-1.7,13.3-6.1,19.3c-23.3,32.1-49.8,61.1-79.9,87c-2.6,2.2-5.3,2.5-8.3,2.4c-6.1-0.2-14.2,1.9-17.9-1.1
                                                c-3.9-3.2-1.1-11.6-1.2-17.7C1167.7,982.2,1167.9,969.6,1167.9,956.9z"/>
                                            <path class="st2 zone-svg" d="M676.9,834c0-17.2,0.1-34.3-0.1-51.5c0-3.7,1.1-4.4,4.7-4.8c11.2-1.2,18.8,2.1,26.2,11.7
                                                c20.2,26.3,46.8,44.6,77.9,56.3c3.1,1.2,4.4,2.4,4.4,5.9c-0.2,11.7-0.2,23.3,0,35c0,3.3-0.9,4.3-4.2,4.3
                                                c-34.8-0.1-69.6-0.1-104.4,0c-3.5,0-4.5-1-4.5-4.5C676.9,869,676.9,851.5,676.9,834z"/>
                                            <path class="st10 zone-svg" d="M979,409.9c17,0,34,0.2,50.9-0.1c4.5-0.1,5.5,1.4,5.5,5.6c-0.2,34-0.2,67.9,0,101.9c0,4.8-1.7,5.2-5.9,5.8
                                                c-12.3,1.7-19.8-3-27.2-13.3c-19.4-27-45.4-46.6-76.2-59.4c-3.2-1.3-4.2-2.9-4.1-6.2c0.2-10,0.2-20,0-30c-0.1-3.5,1.1-4.5,4.5-4.5
                                                C944.1,409.9,961.6,409.9,979,409.9z"/>
                                            <path class="st2 zone-svg" d="M2207,409.3c17,0,34,0.1,50.9-0.1c3.7,0,5.3,0.6,5.1,4.9c-0.3,11.5-0.2,23,0,34.5c0,2.9-0.9,4.5-3.4,5.9
                                                c-35.4,20.6-70.7,41.2-105.9,62c-3.8,2.3-3.8,0.6-3.8-2.5c0.1-33.3,0.1-66.6,0-99.9c0-3.7,0.9-4.8,4.7-4.8
                                                C2172.1,409.4,2189.6,409.3,2207,409.3z"/>
                                            <path class="st10 zone-svg" d="M1715.5,277c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.2-0.6-5.1-4.8c0.3-12.6,0.2-25.3,0.1-38
                                                c0-2.7,0.9-4.2,3.2-5.5c33.5-19.8,69-35.2,106.1-46.8c3.2-1,3.9-0.4,3.9,2.9c-0.1,29.3-0.1,58.6,0,87.9c0,3.8-1.5,4.2-4.7,4.2
                                                C1750.1,276.9,1732.8,277,1715.5,277z"/>
                                            <path class="st8 zone-svg" d="M686.8,404.3c34.4,3.7,69,7.4,103.6,11c3.8,0.4,5.4,1.3,4.7,5.6c-1.4,9.2-2.3,18.5-3,27.8
                                                c-0.2,2.7-1.5,3.3-3.6,3.8C748,462.3,715,484,688.2,515.8c-4.2,5-10.4,0.9-15.4,0.3c-3.4-0.4-1-4.2-0.8-6.3
                                                c3.5-33.9,7.2-67.8,10.9-101.8C683.1,405.5,683.1,403.1,686.8,404.3z"/>
                                            <path class="st6 zone-svg" d="M395.9,718.1c9.9-1,19.7-2.4,29.6-3c4.4-0.3,4.6-2,4.2-5.6c-1.4-11.5-2.4-23-3.6-34.5
                                                c19.7,1.7,39.4,3.4,59.1,4.9c2.9,0.2,4.1,1,4.1,4.1c-0.1,23.2-0.2,46.3-0.1,69.5c0,2.5-0.8,3.8-3.2,4.8
                                                c-29.5,12.7-59,25.5-88.4,38.4c-4,1.8-4.6,0.7-4.5-3.3C394.1,768.3,395,743.2,395.9,718.1z"/>
                                            <path class="st5 zone-svg" d="M1715.4,1023.2c17.5,0,35,0.1,52.5-0.1c3.3,0,4.2,0.8,4.2,4.1c-0.1,28-0.1,56,0,84c0,3.4-0.8,3.7-3.8,2.8
                                                c-37.2-11.2-72.7-26.5-106.4-46c-2.1-1.2-3-2.6-2.9-5.1c0.1-12,0.2-24,0-36c-0.1-3.2,1.1-3.8,4-3.8
                                                C1680.4,1023.2,1697.9,1023.2,1715.4,1023.2z"/>
                                            <path class="st5 zone-svg" d="M197.6,223.9c-31.5-3.8-62.8-7.6-94.2-11.4c-8.4-1-16.8-2.2-25.3-3c-3-0.3-3.4-1.4-2.7-4.1
                                                c1.5-6,2.9-12,3.9-18c0.8-4.9,3.2-8.4,6.8-11.7c18.7-17.3,41.7-27.9,63-41.1c1.4-0.9,2.9-0.7,4.3-0.5c9.2,1.5,18.4,3.2,27.6,4.4
                                                c3.3,0.4,4.3,2,4.9,4.9c4.7,25.7,9.5,51.3,14.4,77C200.7,222.9,201.1,224.8,197.6,223.9z"/>
                                            <path class="st8 zone-svg" d="M152,778.5c-27.5-0.8-54.7-3.7-81.7-9.2c-3.3-0.7-3.5-1.6-2.6-4.5c6.4-21.7,12.6-43.4,18.7-65.1
                                                c0.9-3.3,2.1-4.2,5.5-3.4c32.1,7.3,64.2,14.5,96.3,21.5c3.5,0.8,4.3,1.7,3.2,5.2c-5.1,17-9.9,34.1-14.7,51.2
                                                c-0.8,2.9-1.8,4.5-5.3,4.4C165,778.3,158.5,778.6,152,778.5z"/>
                                            <path class="st9 zone-svg" d="M1290.8,589c0-17.3,0.1-34.6-0.1-52c0-3.8,1-4.7,4.7-4.6c17,0.2,34,0.2,51,0c3,0,4.2,0.8,5,3.9
                                                c7.8,34.4,11.7,69.2,12.2,104.4c0.1,4.2-1.4,4.9-5.1,4.9c-20.8-0.2-41.6-0.2-62.5,0c-4,0-5.4-0.8-5.3-5.1
                                                C1291,623.3,1290.8,606.2,1290.8,589z"/>
                                            <path class="st10 zone-svg" d="M1290.9,711.2c0-17.1,0.1-34.3-0.1-51.4c0-3.5,0.6-4.9,4.6-4.9c21.1,0.2,42.3,0.2,63.4,0c3.5,0,4.5,1,4.4,4.5
                                                c-0.9,35.5-5.6,70.5-14.1,105c-0.7,2.9-2,3.6-4.8,3.6c-16.1-0.1-32.3-0.2-48.4,0c-3.9,0-5.1-0.9-5-4.9
                                                C1291,745.9,1290.9,728.5,1290.9,711.2z"/>
                                            <path class="st2 zone-svg" d="M1526.7,466.2c0,17.2-0.1,34.3,0.1,51.5c0,3.6-0.6,5.3-4.9,5.3c-24.8-0.2-49.7-0.2-74.5,0
                                                c-3.8,0-5-0.7-3.9-4.8c9.7-36.5,23.3-71.5,40.9-104.9c1.5-2.9,3.2-4.1,6.6-4c10.3,0.2,20.7,0.2,31,0c3.9-0.1,4.8,1.3,4.7,4.9
                                                C1526.6,431.5,1526.6,448.9,1526.7,466.2z"/>
                                            <path class="st5 zone-svg" d="M1781.8,778.8c14.8,21.8,32,38.9,53.2,51.8c17,10.2,35.2,17.3,54.7,20.4c4.1,0.7,5.3,2.2,5.2,6.3
                                                c-0.4,9.5-0.3,19,0,28.5c0.1,3.7-0.6,5.1-4.8,5.1c-34.6-0.2-69.3-0.1-103.9-0.1c-2.4,0-4.4,0.3-4.4-3.4
                                                C1781.9,851.8,1781.8,816.2,1781.8,778.8z"/>
                                            <path class="st5 zone-svg" d="M1526.5,834.3c0,17.3-0.1,34.7,0.1,52c0,3.8-1.1,4.8-4.8,4.7c-10.2-0.2-20.3-0.2-30.5,0
                                                c-2.7,0-4.1-0.9-5.4-3.2c-18.2-33.6-32-69-41.9-105.9c-1-3.6,0.1-4,3.3-4c25,0.1,50,0.1,75,0c3.7,0,4.3,1.1,4.3,4.5
                                                C1526.4,799.6,1526.5,816.9,1526.5,834.3z"/>
                                            <path class="st3 zone-svg" d="M155.7,664c-0.9-0.9-1.7-1.8-2.4-2.6c-20.5-22.5-35.2-48.7-49.4-75.3c-1.1-2.1-0.7-3.2,1-4.6
                                                c14.4-12.3,28.8-24.7,43.1-37.2c2.2-1.9,3.3-1.1,4.8,0.6c19.5,22.3,39.1,44.5,58.7,66.8c1.7,1.9,1.9,2.9-0.2,4.7
                                                c-17.9,15.2-35.6,30.6-53.4,45.9C157.2,662.9,156.6,663.3,155.7,664z"/>
                                            <path class="st2 zone-svg" d="M1781.9,515.8c0-2.9,0-4.1,0-5.4c0-32,0.1-63.9-0.1-95.9c0-4.2,1.2-5.3,5.3-5.2c34.1,0.2,68.3,0.2,102.4,0
                                                c4.5,0,5.7,1.3,5.5,5.7c-0.3,7.8-0.2,15.6-0.1,23.5c0,2.4-0.6,3.5-3.1,4C1845.2,450.7,1809.5,475.7,1781.9,515.8z"/>
                                            <path class="st5 zone-svg" d="M1101.2,277c-17.5,0-35-0.1-52.5,0.1c-3.1,0-3.9-0.8-3.8-3.9c0.1-25.5,0.1-51,0-76.5c0-3.1,0.3-4.1,3.7-2.8
                                                c37.9,14.5,73.7,33,107.1,56c1.9,1.3,2.5,2.8,2.4,4.9c-0.2,7.2,2.6,16.6-1,20.8c-3.6,4.4-13.4,1.1-20.5,1.2
                                                C1124.9,277.2,1113.1,277,1101.2,277z"/>
                                            <path class="st3 zone-svg" d="M610.8,1023.2c17.1,0,34.3,0.1,51.4-0.1c3.5,0,4.9,0.6,4.9,4.5c-0.2,23.8-0.2,47.6,0,71.4
                                                c0,4.2-1.2,4.1-4.5,2.9c-36.4-13.5-71-30.8-103.6-51.9c-3.8-2.4-5.2-5-5.2-9.5c0.3-17.3,0.1-17.3,17.5-17.3
                                                C584.5,1023.2,597.7,1023.2,610.8,1023.2z"/>
                                            <path class="st2 zone-svg" d="M1101.7,1023.1c17.3,0,34.6,0.1,52-0.1c3.5,0,4.2,1,4.6,4.4c1.2,9.2-2.3,14.5-10.2,19.6
                                                c-30.9,20-63.2,36.9-97.3,50.6c-4.5,1.8-5.9,1.5-5.8-3.9c0.3-21.8,0.2-43.6,0-65.5c0-4,0.9-5.4,5.2-5.4
                                                C1067.4,1023.3,1084.5,1023.1,1101.7,1023.1z"/>
                                            <path class="st3 zone-svg" d="M2017.6,827.8c0,20.6,0,40.2,0,59.8c0,2.8-1.3,3.2-3.7,3.2c-35.3-0.1-70.6-0.1-105.9,0c-3,0-3.7-1.1-3.6-3.8
                                                c0.1-10.2,0.1-20.3,0-30.5c0-2.4,0.5-3.6,3.4-3.4C1946.6,856,1983.2,848.7,2017.6,827.8z"/>
                                            <path class="st5 zone-svg" d="M357.8,886.7c-37.7-2.9-74.9-10.3-111.3-22.2c-3.7-1.2-4.3-2.2-1.9-5.5c10.2-14.6,20.2-29.3,30-44.1
                                                c2-3.1,3.3-2.9,6.1-1c28.8,19.7,57.7,39.3,86.7,58.8c2.8,1.9,3.4,3.3,0.9,5.7C365.1,881.4,365.1,888.2,357.8,886.7z"/>
                                            <path class="st3 zone-svg" d="M1290.8,466.1c0-16.7-0.1-33.3,0.1-50c0-2-2-5.9,1.9-6c4-0.1,8.7-2.5,11.8,3.2c17.5,32.1,31.3,65.7,41.2,100.9
                                                c2.4,8.7,2.4,8.7-6.6,8.7c-14.3,0-28.7-0.2-43,0.1c-4.3,0.1-5.7-0.8-5.6-5.4C1291,500.4,1290.8,483.2,1290.8,466.1z"/>
                                            <path class="st5 zone-svg" d="M1961.3,409.5c17,0,34,0.1,50.9-0.1c4-0.1,5.4,0.8,5.4,5.1c-0.3,16-0.2,32-0.1,47.9c0,3.3-0.5,4.2-3.7,2.2
                                                c-32.1-19.9-67.4-26.4-104.6-24.4c-3.8,0.2-4.9-0.5-4.8-4.4c0.3-7.1,0.3-14.3,0-21.5c-0.2-3.9,0.9-5.1,4.9-5
                                                C1926.7,409.6,1944,409.5,1961.3,409.5z"/>
                                            <path class="st10 zone-svg" d="M2272.9,298.6c17.6,18.5,32.8,37.2,46.6,57.1c9,12.9,17.2,26.1,25.1,39.6c1.9,3.3,2.6,4.8-2.5,4.7
                                                c-21.7-0.2-43.3-0.1-65-0.1c-2.1,0-4.3,0.5-4.3-3C2272.9,364.7,2272.9,332.4,2272.9,298.6z"/>
                                            <path class="st3 zone-svg" d="M856,890.8c-17.2,0-34.3-0.1-51.5,0.1c-3.7,0-5.3-0.7-5.2-4.9c0.3-10.5,0.2-21,0.1-31.5c0-3.1,0.6-4.1,4-3.2
                                                c35.1,9.1,70.1,8.9,105-1c3.5-1,4.3-0.1,4.3,3.3c-0.2,11-0.2,22,0,33c0.1,3.7-1.4,4.3-4.7,4.3C890.6,890.8,873.3,890.8,856,890.8z"
                                                />
                                            <path class="st8 zone-svg" d="M2250.8,277c-33.5,0-65.6,0-97.6,0c-2.3,0-3.2-0.6-3.2-3c0.1-20.8,0.1-41.6,0-62.4c0-2.8,0.8-3,3.1-1.8
                                                C2188.4,227.5,2220.5,249.6,2250.8,277z"/>
                                            <path class="st5 zone-svg" d="M1290.8,835c0-17.5,0.1-35-0.1-52.5c0-3.5,0.5-4.9,4.5-4.8c15.1,0.3,30.3,0.2,45.5,0c3.4,0,4.6,0.2,3.4,4.2
                                                c-11.1,37.6-26.7,73.3-46.4,107.1c-1.2,2.1-2.5,4.1-5.3,3.3c-3-0.8-1.5-3.4-1.5-5C1290.8,869.9,1290.8,852.5,1290.8,835z"/>
                                            <path class="st5 zone-svg" d="M2272.8,993.2c0-9.6,0-18.7,0-27.7c0-20.3,0.1-40.6-0.1-60.9c0-3.5,0.9-4.5,4.4-4.4c21,0.2,41.9,0.1,62.9,0.1
                                                c2.6,0,4.8-0.5,2.4,3.4c-19.7,31.7-42.1,61.4-67.9,88.5C2274.3,992.3,2273.8,992.5,2272.8,993.2z"/>
                                            <path class="st6 zone-svg" d="M856.1,409.9c17,0,34,0.1,50.9-0.1c4.2-0.1,5.4,1.3,5.3,5.4c-0.3,8.6-0.2,17.3,0,26c0.1,3.4-0.9,3.8-4,2.9
                                                c-34.4-10.1-69-10.9-103.9-2.6c-3.7,0.9-4.8,0.2-4.7-3.6c0.2-7.7,0.2-15.3,0-23c-0.1-3.9,1-5.2,5-5.1
                                                C821.8,410,839,409.9,856.1,409.9z"/>
                                            <path class="st1 zone-svg" d="M2241.8,1023.2c-28.1,24.1-57.3,43.6-89,59.5c-2.7,1.4-2.9,0.3-2.9-2.1c0.1-18,0-35.9,0-53.9
                                                c0-1.9-0.2-3.6,2.7-3.5C2181.9,1023.2,2211.1,1023.2,2241.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M2335.4,409.5c-1.6,1.3-2.2,1.9-3,2.3c-18.6,10.9-37.3,21.8-55.9,32.8c-3,1.8-3.8,1.6-3.7-2
                                                c0.2-9.8,0.2-19.6,0-29.5c0-2.9,0.9-3.7,3.7-3.6C2295.6,409.5,2314.8,409.5,2335.4,409.5z"/>
                                            <path class="st5 zone-svg" d="M481.9,80.8c19.4-8.7,38.5-15.6,57.6-22.4c2.9-1,2.7,0.5,2.3,2.4c-2.2,11.2-4.4,22.4-6.5,33.7
                                                c-0.4,1.9-0.7,3.2-3,2.4C515.7,91.6,499.2,86.3,481.9,80.8z"/>
                                            <path class="st5 zone-svg" d="M2108.5,768c-9.1,0-18.3-0.1-27.4,0c-2.8,0-3.6-0.3-1.8-3.1c5.5-8.5,10.9-17.1,16-25.8c1.5-2.6,2.7-2.5,5-1.2
                                                c12.4,7.1,24.8,14.2,37.3,21c3.5,1.9,2.7,4.6,2.6,7.2c-0.2,3.4-3.1,1.7-4.7,1.7C2126.4,768.1,2117.5,768,2108.5,768z"/>
                                            <path class="st5 zone-svg" d="M1594.5,277c17.8-15,35.3-28.1,54.6-40.2c0,13.1,0,25.5,0,37.9c0,1.7-0.5,2.4-2.3,2.4
                                                C1629.9,277,1612.8,277,1594.5,277z"/>
                                            <path class="st5 zone-svg" d="M1526.5,348.4c0,18.2,0,34.6,0,51c0,2.1-1.2,2.4-2.9,2.4c-9.7,0-19.3-0.1-29,0c-2.5,0-3.4-0.4-1.9-3
                                                C1502.6,381.8,1513.4,365.5,1526.5,348.4z"/>
                                            <path class="st2 zone-svg" d="M1597.8,1023.1c16.8,0,32.1,0.1,47.4-0.1c3.1,0,4,1,4,4c-0.2,9.8-0.1,19.6-0.1,29.5c0,2,0.2,3.9-2.8,2
                                                C1629.8,1048,1614,1036.5,1597.8,1023.1z"/>
                                            <path class="st2 zone-svg" d="M1526.7,949.9c-12.4-15.9-22.4-31.1-31.8-46.8c-1.3-2.2-0.6-2.9,1.8-2.9c9,0,18,0,26.9,0c2,0,3.1,0.6,3.1,2.8
                                                C1526.6,918,1526.7,933,1526.7,949.9z"/>
                                            <path class="st5 zone-svg" d="M2126.3,532.5c-12.3,7.2-23.1,13.3-33.7,19.8c-2.7,1.6-3.1-0.2-4-1.7c-2.8-4.9-5.4-9.9-8.4-14.7
                                                c-2.1-3.3-0.5-3.4,2.2-3.4C2096.4,532.5,2110.4,532.5,2126.3,532.5z"/>
                                            <path class="st2 zone-svg" d="M311,211c-7,9.8-16.7,17.1-24.6,26c-1.3,1.5-2.4,0.6-3.4-0.2c-5.9-4.3-11.8-8.7-18.7-13.7
                                                C280.5,218.7,295.4,213.6,311,211L311,211z"/>
                                            <path class="st3 zone-svg" d="M1035.6,727.4c0,12.4,0,24.9,0,37.3c0,1.1,0.4,2.9-1,3c-6,0.2-12,0.3-17.9,0c-1.3-0.1-0.4-1.6,0.1-2.3
                                                C1023.9,753.2,1029.9,740.5,1035.6,727.4z"/>
                                            <path class="st2 zone-svg" d="M284,961c-13.5-6.9-25.7-15.8-39.5-24.1c10.6,0,20.1,0,29.6,0c1.2,0,1.9,0.6,2.2,1.6
                                                C278.8,946.1,282.8,953.1,284,961L284,961z"/>
                                            <path class="st5 zone-svg" d="M1035.5,568.6c-5.2-11.4-10-22.8-16.2-33.6c-1.2-2.1-0.4-2.6,1.7-2.5c0.2,0,0.3,0,0.5,0
                                                c14.1-0.8,14.1-0.8,14.1,13.2C1035.5,553.3,1035.5,560.9,1035.5,568.6z"/>
                                            <path class="st3 zone-svg" d="M1191.4,277c-3.9,0-6.2,0-8.5,0c-17,0-17,0-14.6-18.1c3.9,3,7.6,5.7,11.2,8.5
                                                C1183.2,270.3,1186.7,273.2,1191.4,277z"/>
                                            <path class="st5 zone-svg" d="M676.8,740.8c4.8,8.9,9,16.6,13.1,24.3c0.4,0.7,0.9,2.1,0.9,2.1c-3.7,1.7-7.7,0.3-11.5,0.8
                                                c-2,0.2-2.5-0.8-2.5-2.6C676.9,757.6,676.8,749.8,676.8,740.8z"/>
                                            <path class="st5 zone-svg" d="M522,1023.2c7.6,0,13.6,0.1,19.5,0c3.8-0.1,2.7,2.6,2.7,4.5c0,3.7-0.3,7.5-0.5,11.2c-3.8-1.1-6.3-4-9.3-6.2
                                                C530.5,1030,527,1027,522,1023.2z"/>
                                            <path class="st5 zone-svg" d="M676.8,551.5c0-6.4,0.1-11,0-15.6c-0.1-2.5,0.5-3.8,3.3-3.4c1.9,0.3,3.8,0.4,5.7,0.6c-0.7,1.6-1.4,3.2-2.2,4.8
                                                C681.5,542,679.5,546.1,676.8,551.5z"/>
                                            <path class="st5 zone-svg" d="M1180.8,1023.2c-4.5,3.4-7.7,5.9-10.9,8.2c-0.4,0.3-1.2,0.2-1.8,0.3c-0.1-2.1-0.2-4.3-0.2-6.4
                                                c-0.1-1.4,0.5-2.1,2-2.1C1173,1023.2,1176,1023.2,1180.8,1023.2z"/>
                                            <path class="st5 zone-svg" d="M1290.8,390c2.2,3.6,3.7,6,5,8.4c0.5,0.9,0.6,2.1,0.9,3.2c-1.3,0.1-2.6,0.1-4,0.2c-1.5,0.1-2-0.7-2-2.1
                                                C1290.9,397,1290.8,394.2,1290.8,390z"/>
                                            <path class="st5 zone-svg" d="M2017.2,166.1c-3.7-0.6-7.4-1.3-11.1-1.9C2009.8,164.8,2014.1,161.8,2017.2,166.1z"/>
                                            <path class="st2 zone-svg" d="M311,211c0.1-0.2,0.3-0.3,0.4-0.5c0,0.1,0,0.3-0.1,0.3C311.3,210.9,311.1,210.9,311,211
                                                C311,211,311,211,311,211z"/>
                                            <path class="st2 zone-svg" d="M284,961c0.2,0.1,0.3,0.2,0.5,0.3c-0.1,0-0.2,0-0.3,0C284.1,961.2,284.1,961.1,284,961
                                                C284,961,284,961,284,961z"/>
                                        </g>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/lengow.png' alt='Lengow' class='no-scroll'>-->
                                        <svg class='svg-algolia' xmlns="http://www.w3.org/2000/svg" width="402" height="127.031" viewBox="0 0 402 127.031">
                                          <path class="algo-1 zone-svg" d="M169.907,278.234q-2.231-5.932-4.194-11.663t-4.064-11.662h-41.16l-8.258,23.325H98.991q5.241-14.494,9.831-26.816t8.98-23.389q4.389-11.072,8.717-21.15t9.044-19.962H147.23q4.719,9.882,9.045,19.962t8.718,21.15q4.389,11.067,8.978,23.389t9.832,26.816h-13.9Zm-11.928-33.865q-4.2-11.466-8.323-22.2t-8.587-20.623q-4.59,9.885-8.716,20.623t-8.194,22.2h33.82Zm57.806,35.181q-11.272-.264-15.99-4.876t-4.718-14.362V178.086l12.188-2.108v82.357a20.034,20.034,0,0,0,.524,5.009,6.909,6.909,0,0,0,1.7,3.162,7.356,7.356,0,0,0,3.148,1.779,32.461,32.461,0,0,0,4.848.989l-1.7,10.276m58.071-8.17a32.188,32.188,0,0,1-6.095,2.7,30.8,30.8,0,0,1-10.553,1.648,33.738,33.738,0,0,1-11.6-1.976,25.2,25.2,0,0,1-9.5-6.128,29.653,29.653,0,0,1-6.423-10.344,41.5,41.5,0,0,1-2.359-14.758,40.775,40.775,0,0,1,2.228-13.771,30.59,30.59,0,0,1,6.49-10.8,29.728,29.728,0,0,1,10.42-7.116,35.8,35.8,0,0,1,13.895-2.57,77.968,77.968,0,0,1,14.879,1.253q6.357,1.254,10.682,2.305v61.143q0,15.813-8.125,22.927T253.144,303a66.633,66.633,0,0,1-12.124-1.051,69.412,69.412,0,0,1-9.9-2.5l2.228-10.673a56.768,56.768,0,0,0,8.979,2.568,53.642,53.642,0,0,0,11.076,1.121q10.88,0,15.665-4.35t4.784-13.836v-2.9h0Zm-5.046-51.851a59.21,59.21,0,0,0-8.323-.462q-9.831,0-15.141,6.459t-5.309,17.128a30.228,30.228,0,0,0,1.507,10.148,20.123,20.123,0,0,0,4.064,6.984,15.9,15.9,0,0,0,5.9,4.083,18.578,18.578,0,0,0,6.882,1.318A27.483,27.483,0,0,0,267.3,263.8a22.006,22.006,0,0,0,6.424-3.227V220.518A40.416,40.416,0,0,0,268.81,219.529Zm135.453,60.023q-11.276-.267-15.992-4.876t-4.719-14.363V178.088l12.192-2.108v82.355a19.992,19.992,0,0,0,.523,5.009,6.864,6.864,0,0,0,1.706,3.162,7.293,7.293,0,0,0,3.144,1.78,32.371,32.371,0,0,0,4.85.988l-1.7,10.278m21.365-82.225a7.8,7.8,0,0,1-5.568-2.174,8.638,8.638,0,0,1,0-11.727,8.222,8.222,0,0,1,11.142,0,8.643,8.643,0,0,1,0,11.727,7.817,7.817,0,0,1-5.574,2.174h0ZM419.6,209.713h12.191v68.521H419.6V209.713ZM474.785,208a35.211,35.211,0,0,1,12.388,1.911,20.088,20.088,0,0,1,8.126,5.4,20.511,20.511,0,0,1,4.392,8.3A40.352,40.352,0,0,1,501,234.223V277.05q-1.574.262-4.391,0.724t-6.358.855q-3.54.4-7.668,0.724t-8.193.33a44.694,44.694,0,0,1-10.618-1.185,23.73,23.73,0,0,1-8.39-3.755,17.172,17.172,0,0,1-5.5-6.787,23.858,23.858,0,0,1-1.966-10.147,19.59,19.59,0,0,1,2.3-9.751,18.3,18.3,0,0,1,6.225-6.588,28.783,28.783,0,0,1,9.176-3.69,49.8,49.8,0,0,1,11.011-1.186q1.833,0,3.8.2c1.31,0.132,2.556.311,3.735,0.529s2.207,0.416,3.082.592,1.484,0.309,1.834.395v-3.426a27.708,27.708,0,0,0-.655-6,13.782,13.782,0,0,0-2.36-5.269,11.972,11.972,0,0,0-4.654-3.691,18.188,18.188,0,0,0-7.668-1.383,57.313,57.313,0,0,0-10.553.857,36.955,36.955,0,0,0-6.75,1.778l-1.442-10.146a37.5,37.5,0,0,1,7.865-2.042A67.479,67.479,0,0,1,474.785,208h0Zm1.049,61.4q4.325,0,7.669-.2a33.169,33.169,0,0,0,5.57-.724V248.058a15.693,15.693,0,0,0-4.259-1.119,47.2,47.2,0,0,0-7.145-.464,45.835,45.835,0,0,0-5.833.4,17.913,17.913,0,0,0-5.636,1.646,12.054,12.054,0,0,0-4.261,3.427,9.027,9.027,0,0,0-1.7,5.732q0,6.588,4.194,9.157t11.405,2.57h0Z" transform="translate(-99 -175.969)"/>
                                          <path class="algo-2 zone-svg" d="M340.344,225.11l-5.246,18.6,16.9-9.267A19.341,19.341,0,0,0,340.344,225.11Zm-32.5-15.2a6.455,6.455,0,0,0-9.157,0l-1.144,1.15a6.534,6.534,0,0,0,0,9.2l1.219,1.223a42.536,42.536,0,0,1,9.735-10.917Zm39.55-6.369c0.009-.14.04-0.273,0.04-0.416v-3.254a6.493,6.493,0,0,0-6.473-6.507h-11.33a6.492,6.492,0,0,0-6.472,6.507v3.2a41.727,41.727,0,0,1,24.235.473M334.947,218.32A25.779,25.779,0,1,1,309.188,244.1a25.8,25.8,0,0,1,25.759-25.779M298.885,244.1a36.062,36.062,0,1,0,36.062-36.091A36.075,36.075,0,0,0,298.885,244.1Z" transform="translate(-99 -175.969)"/>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/antvoice.png' alt='AntVoice' class='no-scroll'>-->
                                        <svg class='svg-iadvize' xmlns="http://www.w3.org/2000/svg" width="401" height="97" viewBox="0 0 401 97">
                                          <path data-name="Forme 1" class="cls-1 zone-svg" d="M213.532,206.236a7.134,7.134,0,0,1,7.02,7.052,6.9,6.9,0,0,1-13.807,0A7.094,7.094,0,0,1,213.532,206.236ZM207.8,231.625a5.617,5.617,0,1,1,11.233,0v35.733a5.617,5.617,0,1,1-11.233,0V231.625Zm52.887-23.274,28.9,56.538a5.82,5.82,0,0,1,.585,2.351,5.562,5.562,0,0,1-5.5,5.76,5.307,5.307,0,0,1-5.031-3.056l-6.318-11.872H241.847l-6.436,11.872A5.306,5.306,0,0,1,230.38,273a5.562,5.562,0,0,1-5.5-5.76,5.8,5.8,0,0,1,.585-2.351l28.9-56.538A3.417,3.417,0,0,1,260.685,208.351Zm-13.573,39.965h20.944L257.526,228.8ZM364.47,271.354l-20.125-37.378a4.682,4.682,0,0,1-.468-2.351,5.557,5.557,0,0,1,5.616-5.642,5.21,5.21,0,0,1,5.032,2.939l12.4,23.508,12.4-23.508a5.209,5.209,0,0,1,5.032-2.939,5.557,5.557,0,0,1,5.616,5.642,4.682,4.682,0,0,1-.469,2.351l-20.124,37.378A2.658,2.658,0,0,1,364.47,271.354Zm37.107-65.118a7.134,7.134,0,0,1,7.02,7.052,6.9,6.9,0,0,1-13.806,0A7.093,7.093,0,0,1,401.577,206.236Zm-5.733,25.389a5.616,5.616,0,1,1,11.232,0v35.733a5.616,5.616,0,1,1-11.232,0V231.625ZM415.617,273a2.478,2.478,0,0,1-2.106-2.587c0-.352.117-0.587,0.117-0.94l20.593-33.146H417.957a5.006,5.006,0,0,1-5.031-5.055,5.135,5.135,0,0,1,5.031-5.289h31.358a2.476,2.476,0,0,1,2.106,2.586c0,0.353-.117.587-0.117,0.94l-20.71,33.5h16.381a4.811,4.811,0,0,1,4.915,4.937A4.91,4.91,0,0,1,446.975,273H415.617Zm61.062-.232a23.393,23.393,0,0,1,.028-46.785,23.019,23.019,0,0,1,16.487,6.98A23.661,23.661,0,0,1,500,249.532a5.422,5.422,0,0,1-5.265,5.455H465.074c2,3.614,6.451,7.37,11.6,7.37a12.75,12.75,0,0,0,8.482-3.364,5.254,5.254,0,1,1,7.028,7.813A23.132,23.132,0,0,1,476.679,272.768Zm-11.593-28.624h23.2a12.039,12.039,0,0,0-11.582-7.518C471.551,236.626,467.1,239.174,465.086,244.144ZM332.441,206.236a5.567,5.567,0,0,0-5.4,5.861v17.554a23.688,23.688,0,0,0-12.614-3.624,23.357,23.357,0,0,0-.137,46.713,22.98,22.98,0,0,0,12.635-3.77,5.562,5.562,0,0,0,10.909-1.612v-55.48A5.377,5.377,0,0,0,332.441,206.236Zm-18.194,55.518a12.371,12.371,0,1,1,12.315-12.371A12.356,12.356,0,0,1,314.247,261.754Z" transform="translate(-99 -176)"/>
                                          <path data-name="Forme 1 copie" class="cls-2 zone-svg" d="M109.826,255.1a48.988,48.988,0,0,1-8.958-44.289,46.956,46.956,0,0,1,32.24-32.782c32.73-9.37,62.449,15.064,62.449,46.472a48.4,48.4,0,0,1-46.752,48.471L148.821,273H104.269a2.793,2.793,0,0,1-2.4-4.2Z" transform="translate(-99 -176)"/>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/happn.png' alt='Happn' class='no-scroll'>-->
                                        <svg class='svg-algolia' xmlns="http://www.w3.org/2000/svg" width="402" height="127.031" viewBox="0 0 402 127.031">
                                          <path class="algo-1 zone-svg" d="M169.907,278.234q-2.231-5.932-4.194-11.663t-4.064-11.662h-41.16l-8.258,23.325H98.991q5.241-14.494,9.831-26.816t8.98-23.389q4.389-11.072,8.717-21.15t9.044-19.962H147.23q4.719,9.882,9.045,19.962t8.718,21.15q4.389,11.067,8.978,23.389t9.832,26.816h-13.9Zm-11.928-33.865q-4.2-11.466-8.323-22.2t-8.587-20.623q-4.59,9.885-8.716,20.623t-8.194,22.2h33.82Zm57.806,35.181q-11.272-.264-15.99-4.876t-4.718-14.362V178.086l12.188-2.108v82.357a20.034,20.034,0,0,0,.524,5.009,6.909,6.909,0,0,0,1.7,3.162,7.356,7.356,0,0,0,3.148,1.779,32.461,32.461,0,0,0,4.848.989l-1.7,10.276m58.071-8.17a32.188,32.188,0,0,1-6.095,2.7,30.8,30.8,0,0,1-10.553,1.648,33.738,33.738,0,0,1-11.6-1.976,25.2,25.2,0,0,1-9.5-6.128,29.653,29.653,0,0,1-6.423-10.344,41.5,41.5,0,0,1-2.359-14.758,40.775,40.775,0,0,1,2.228-13.771,30.59,30.59,0,0,1,6.49-10.8,29.728,29.728,0,0,1,10.42-7.116,35.8,35.8,0,0,1,13.895-2.57,77.968,77.968,0,0,1,14.879,1.253q6.357,1.254,10.682,2.305v61.143q0,15.813-8.125,22.927T253.144,303a66.633,66.633,0,0,1-12.124-1.051,69.412,69.412,0,0,1-9.9-2.5l2.228-10.673a56.768,56.768,0,0,0,8.979,2.568,53.642,53.642,0,0,0,11.076,1.121q10.88,0,15.665-4.35t4.784-13.836v-2.9h0Zm-5.046-51.851a59.21,59.21,0,0,0-8.323-.462q-9.831,0-15.141,6.459t-5.309,17.128a30.228,30.228,0,0,0,1.507,10.148,20.123,20.123,0,0,0,4.064,6.984,15.9,15.9,0,0,0,5.9,4.083,18.578,18.578,0,0,0,6.882,1.318A27.483,27.483,0,0,0,267.3,263.8a22.006,22.006,0,0,0,6.424-3.227V220.518A40.416,40.416,0,0,0,268.81,219.529Zm135.453,60.023q-11.276-.267-15.992-4.876t-4.719-14.363V178.088l12.192-2.108v82.355a19.992,19.992,0,0,0,.523,5.009,6.864,6.864,0,0,0,1.706,3.162,7.293,7.293,0,0,0,3.144,1.78,32.371,32.371,0,0,0,4.85.988l-1.7,10.278m21.365-82.225a7.8,7.8,0,0,1-5.568-2.174,8.638,8.638,0,0,1,0-11.727,8.222,8.222,0,0,1,11.142,0,8.643,8.643,0,0,1,0,11.727,7.817,7.817,0,0,1-5.574,2.174h0ZM419.6,209.713h12.191v68.521H419.6V209.713ZM474.785,208a35.211,35.211,0,0,1,12.388,1.911,20.088,20.088,0,0,1,8.126,5.4,20.511,20.511,0,0,1,4.392,8.3A40.352,40.352,0,0,1,501,234.223V277.05q-1.574.262-4.391,0.724t-6.358.855q-3.54.4-7.668,0.724t-8.193.33a44.694,44.694,0,0,1-10.618-1.185,23.73,23.73,0,0,1-8.39-3.755,17.172,17.172,0,0,1-5.5-6.787,23.858,23.858,0,0,1-1.966-10.147,19.59,19.59,0,0,1,2.3-9.751,18.3,18.3,0,0,1,6.225-6.588,28.783,28.783,0,0,1,9.176-3.69,49.8,49.8,0,0,1,11.011-1.186q1.833,0,3.8.2c1.31,0.132,2.556.311,3.735,0.529s2.207,0.416,3.082.592,1.484,0.309,1.834.395v-3.426a27.708,27.708,0,0,0-.655-6,13.782,13.782,0,0,0-2.36-5.269,11.972,11.972,0,0,0-4.654-3.691,18.188,18.188,0,0,0-7.668-1.383,57.313,57.313,0,0,0-10.553.857,36.955,36.955,0,0,0-6.75,1.778l-1.442-10.146a37.5,37.5,0,0,1,7.865-2.042A67.479,67.479,0,0,1,474.785,208h0Zm1.049,61.4q4.325,0,7.669-.2a33.169,33.169,0,0,0,5.57-.724V248.058a15.693,15.693,0,0,0-4.259-1.119,47.2,47.2,0,0,0-7.145-.464,45.835,45.835,0,0,0-5.833.4,17.913,17.913,0,0,0-5.636,1.646,12.054,12.054,0,0,0-4.261,3.427,9.027,9.027,0,0,0-1.7,5.732q0,6.588,4.194,9.157t11.405,2.57h0Z" transform="translate(-99 -175.969)"/>
                                          <path class="algo-2 zone-svg" d="M340.344,225.11l-5.246,18.6,16.9-9.267A19.341,19.341,0,0,0,340.344,225.11Zm-32.5-15.2a6.455,6.455,0,0,0-9.157,0l-1.144,1.15a6.534,6.534,0,0,0,0,9.2l1.219,1.223a42.536,42.536,0,0,1,9.735-10.917Zm39.55-6.369c0.009-.14.04-0.273,0.04-0.416v-3.254a6.493,6.493,0,0,0-6.473-6.507h-11.33a6.492,6.492,0,0,0-6.472,6.507v3.2a41.727,41.727,0,0,1,24.235.473M334.947,218.32A25.779,25.779,0,1,1,309.188,244.1a25.8,25.8,0,0,1,25.759-25.779M298.885,244.1a36.062,36.062,0,1,0,36.062-36.091A36.075,36.075,0,0,0,298.885,244.1Z" transform="translate(-99 -175.969)"/>
                                        </svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/birchbox.png' alt='Birchbox' class='no-scroll'>-->
                                        <svg class='svg-akeneo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 338.22 73.37"><defs><linearGradient id="Dégradé_sans_nom" x1="313.56" y1="-514.57" x2="382.56" y2="-514.57" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="0.97" stop-color="#9452ba"/></linearGradient><linearGradient id="Dégradé_sans_nom_2" x1="367.19" y1="-548.12" x2="367.19" y2="-482.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.04" stop-color="#5f2385"/><stop offset="1" stop-color="#fff"/></linearGradient><linearGradient id="Dégradé_sans_nom_3" x1="332.8" y1="-548.12" x2="332.8" y2="-482.12" xlink:href="#Dégradé_sans_nom_2"/><linearGradient id="Dégradé_sans_nom_4" x1="332.78" y1="-493.12" x2="332.78" y2="-545.12" gradientTransform="matrix(0.88, -0.47, -0.47, -0.88, -510.98, -246.8)" gradientUnits="userSpaceOnUse"><stop offset="0.23" stop-color="#4f1374"/><stop offset="0.84" stop-color="#5f2385"/></linearGradient><linearGradient id="Dégradé_sans_nom_5" x1="367.23" y1="-493.12" x2="367.23" y2="-545.12" xlink:href="#Dégradé_sans_nom_4"/></defs><path d="M109.73,38.8q0-4.68-2.38-6.5t-6.9-1.82a29.27,29.27,0,0,0-5.19.44,39.38,39.38,0,0,0-4.72,1.15A12.35,12.35,0,0,1,89,25.8a36.47,36.47,0,0,1,6-1.35,43.34,43.34,0,0,1,6.26-.48q7.93,0,12,3.61t4.12,11.54V64.57q-2.78.64-6.74,1.31a48.17,48.17,0,0,1-8.09.67,31.62,31.62,0,0,1-7-.71,14.32,14.32,0,0,1-5.31-2.3,10.66,10.66,0,0,1-3.37-4,13.55,13.55,0,0,1-1.19-6,12.12,12.12,0,0,1,5.15-10.27,16.81,16.81,0,0,1,5.47-2.54,24.87,24.87,0,0,1,6.5-.83q2.54,0,4.16.12t2.73,0.28V38.8h0Zm0,7.69q-1.19-.16-3-0.32T103.64,46q-4.92,0-7.49,1.82a6.34,6.34,0,0,0-2.58,5.55,6.82,6.82,0,0,0,.87,3.73,6,6,0,0,0,2.18,2.06,7.58,7.58,0,0,0,2.89.87,30,30,0,0,0,3,.16,36.68,36.68,0,0,0,3.77-.2,22.5,22.5,0,0,0,3.45-.59V46.49h0Z" transform="translate(0.38 -0.21)"/><path d="M128.92,7.48a18.66,18.66,0,0,1,1.94-.24c0.71,0,1.36-.08,1.94-0.08a18.29,18.29,0,0,1,2,.08,18.65,18.65,0,0,1,2,.24V65.6a18.62,18.62,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V7.48Zm8,37L151.84,24.9q1-.16,2.06-0.24t2.14-.08q1.19,0,2.26.08t2.18,0.24l-14.92,19L162.7,65.54q-1.11.16-2.14,0.24t-2.14.08q-1.11,0-2.22-.08L154,65.6Z" transform="translate(0.38 -0.21)"/><path d="M174.27,47.2q0.16,6.66,3.45,9.75T187.43,60a29.13,29.13,0,0,0,10.7-2,11.89,11.89,0,0,1,1,2.89,18.85,18.85,0,0,1,.48,3.37A26.52,26.52,0,0,1,193.86,66a40,40,0,0,1-6.94.55A26.2,26.2,0,0,1,177.41,65,16.72,16.72,0,0,1,167.1,54a28.46,28.46,0,0,1-1.19-8.44,29.9,29.9,0,0,1,1.15-8.44,19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.76,19.76,0,0,1,185.11,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6,24.35,24.35,0,0,1,1.11,7.49q0,1.11-.08,2.34t-0.16,2.1H174.27Zm20.14-5.87a15,15,0,0,0-.59-4.24,10.8,10.8,0,0,0-1.74-3.53,8.51,8.51,0,0,0-2.93-2.42,9.22,9.22,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M212.48,24.92q0.87-.16,1.7-0.24c0.56,0,1.12-.08,1.71-0.08a15.6,15.6,0,0,1,1.63.08q0.75,0.08,1.62.24,0.24,1.19.48,3.21a29.87,29.87,0,0,1,.24,3.37,16.26,16.26,0,0,1,2-2.7,15.57,15.57,0,0,1,2.81-2.42A14.52,14.52,0,0,1,232.84,24q7,0,10.31,4t3.33,11.85V65.6a18.66,18.66,0,0,1-2,.24q-1.11.08-2,.08t-1.94-.08a18.65,18.65,0,0,1-1.94-.24V42q0-5.63-1.75-8.29A6.16,6.16,0,0,0,231.3,31a11.19,11.19,0,0,0-4.2.79,9.33,9.33,0,0,0-3.49,2.46,12.3,12.3,0,0,0-2.42,4.32,19.71,19.71,0,0,0-.91,6.38V65.6a18.65,18.65,0,0,1-1.94.24q-1.07.08-1.94,0.08t-2-.08a18.57,18.57,0,0,1-2-.24V24.92h0.08Z" transform="translate(0.38 -0.21)"/><path d="M264.17,47.2q0.16,6.66,3.45,9.75T277.33,60A29.14,29.14,0,0,0,288,58a12,12,0,0,1,1,2.89,19,19,0,0,1,.47,3.37,26.52,26.52,0,0,1-5.7,1.7,40,40,0,0,1-6.94.55A26.19,26.19,0,0,1,267.35,65,16.72,16.72,0,0,1,257,54a28.47,28.47,0,0,1-1.19-8.44A29.94,29.94,0,0,1,257,37.12a19,19,0,0,1,3.53-6.82,17,17,0,0,1,6-4.6A19.77,19.77,0,0,1,275,24a17.81,17.81,0,0,1,7.37,1.43,15,15,0,0,1,5.31,3.92,17,17,0,0,1,3.25,6A24.32,24.32,0,0,1,292,42.79q0,1.11-.08,2.34t-0.16,2.1H264.17v0Zm20.14-5.87a15,15,0,0,0-.59-4.24A10.82,10.82,0,0,0,282,33.56,8.51,8.51,0,0,0,279,31.14a9.21,9.21,0,0,0-4.24-.91q-4.84,0-7.41,2.93a14.36,14.36,0,0,0-3.13,8.17h20Z" transform="translate(0.38 -0.21)"/><path d="M318.88,66.55a19.91,19.91,0,0,1-8.32-1.62,16.55,16.55,0,0,1-6-4.48,18.61,18.61,0,0,1-3.53-6.74,31.27,31.27,0,0,1,0-16.81,18.63,18.63,0,0,1,3.53-6.74,17,17,0,0,1,6-4.52,21.64,21.64,0,0,1,16.65,0,16.94,16.94,0,0,1,6,4.52,18.66,18.66,0,0,1,3.53,6.74,31.27,31.27,0,0,1,0,16.81,18.65,18.65,0,0,1-3.53,6.74,16.53,16.53,0,0,1-6,4.48A19.92,19.92,0,0,1,318.88,66.55Zm0-6.26q5.47,0,8.09-4t2.62-11q0-7-2.62-11t-8.09-3.92q-5.47,0-8,3.92t-2.58,11q0,7.06,2.58,11t8,4h0Z" transform="translate(0.38 -0.21)"/><path class="ak-1 zone-svg" d="M55.28,71.89c0.27,0.88.51,1.49,0.58,1.69h0c-1.34-19.17,9.75-26.76,13.65-39.33a4.37,4.37,0,0,1,.13-0.62,8.27,8.27,0,0,0,.2-0.86c0.64-3.49-.67-7.63-3.25-12V20.7c-0.21-.36-0.44-0.72-0.67-1.09h0c-0.43-.66-0.88-1.33-1.36-2l-0.15-.21L64,16.85l-0.42-.56-0.43-.55-0.45-.57-0.32-.4A96.15,96.15,0,0,0,47.19.21h0a94.09,94.09,0,0,1-.49,20.13,76,76,0,0,1-7.48,22.08,76,76,0,0,1-22.52-6A92.68,92.68,0,0,1-.3,25.64c0,0.6.1,1.19,0.15,1.79A1.91,1.91,0,0,0-.1,28,11.1,11.1,0,0,0,0,29.24a1.71,1.71,0,0,0,.07.59,10.91,10.91,0,0,0,.15,1.28,1.54,1.54,0,0,0,.06.52c0.07,0.54.14,1.08,0.22,1.61a1.31,1.31,0,0,0,0,.16C0.62,34,.72,34.64.82,35.25v0.14C0.91,35.94,1,36.49,1.11,37l0.06,0.33c0.09,0.5.19,1,.29,1.49a0.52,0.52,0,0,0,.06.29c0.12,0.57.24,1.14,0.37,1.7h0q0.63,2.71,1.39,5.23a0.43,0.43,0,0,1,0,.06,50.57,50.57,0,0,0,3,7.67l0.51,1h0c0.15,0.29.31,0.57,0.47,0.85h0c0.17,0.3.35,0.59,0.53,0.87h0l0.08,0.11h0c0.23,0.36.48,0.71,0.71,1L8.71,57.8v0.06c0.28,0.38.56,0.74,0.86,1.08h0c0.2,0.24.41,0.47,0.62,0.69l0.27,0.27,0.4,0.39,0.31,0.27,0.39,0.33,0.32,0.24,0.41,0.3,0.32,0.21L13,61.91l0.3,0.17,0.51,0.25,0.25,0.12a7.57,7.57,0,0,0,.78.29l0.47,0.18C28,66.71,40.58,61.79,55.78,73.45" transform="translate(0.38 -0.21)"/><path class="ak-2 zone-svg" d="M46.68,20.35A76,76,0,0,1,39.2,42.43c14.25,1.66,28.07-.51,30.45-8.81,2.6-9.06-9.17-23-22.48-33.4A92.76,92.76,0,0,1,46.68,20.35Z" transform="translate(0.38 -0.21)"/><path class="ak-3 zone-svg" d="M16.68,36.41a92.68,92.68,0,0,1-17-10.78C0.9,42.47,6,60,15,62.87c8.22,2.63,17.7-7.67,24.23-20.44A76,76,0,0,1,16.68,36.41Z" transform="translate(0.38 -0.21)"/><path class="ak-4 zone-svg" d="M28,52.37A51.23,51.23,0,0,1-.38,25.63h0c0.77,10.32,3,20.89,6.65,28.2,0.16,0.31.32,0.63,0.49,0.93v0.08q0.24,0.44.48,0.85L7.31,55.8q0.24,0.41.48,0.79L7.87,56.7l0.5,0.76,0.34,0.46L8.79,58,9,58.34c0.19,0.25.39,0.49,0.58,0.72a11.87,11.87,0,0,0,5.31,3.8L15.39,63C28,66.83,40.61,61.91,55.81,73.57,54.7,72,43.9,58.27,28,52.37Z" transform="translate(0.38 -0.21)"/><path class="ak-5 zone-svg" d="M69.65,33.62c2.6-9.06-9.18-23-22.48-33.4h0a51.39,51.39,0,0,1,6.44,38.45c-4,16.8,1.8,33.63,2.25,34.9h0C54.52,54.4,65.61,46.81,69.51,34.24A4.37,4.37,0,0,1,69.65,33.62Z" transform="translate(0.38 -0.21)"/></svg>
                                    </a>
                                </li><li class='col-2'>
                                    <a href='#'>
                                        <!--<img src='img/socloz.png' alt='So Cloz' class='no-scroll'>-->
                                        <svg class='svg-drivy' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273 103.01"><path class="dv-1 zone-svg" d="M71.18,22.1H87.54V81.42H71.18V22.1ZM46.63,24.8A28.81,28.81,0,0,0,32.72,21C14.72,21,0,34.78,0,52,0,69,14.72,82,32.72,82c5.46,0,10.36-1.08,13.91-3.24v2.7H63V3.23H46.63V24.8h0ZM33.27,69A17,17,0,0,1,16.36,52h0A17,17,0,0,1,33.27,35a15.44,15.44,0,0,1,8.46,2.43,16.65,16.65,0,0,1,4.64,4V63.09A18,18,0,0,1,33.27,69ZM117.54,22.1h16.36V81.42H117.54V22.1ZM173.45,55L159.82,22.1H142.09l25.36,59.32h11.73L204.82,22.1H187.09Zm81.82-32.9L241.91,55,228,22.1H210.27l21.82,50.15a8.14,8.14,0,0,1,0,6.2L221.18,103h17.73l9-21.3h0L273,22.1H255.27Zm-154.09-.54a8.63,8.63,0,1,1-8.73,8.63,8.63,8.63,0,0,1,8.73-8.63h0ZM125.73,0A8.63,8.63,0,1,1,117,8.62,8.63,8.63,0,0,1,125.73,0h0Z" transform="translate(0 0.01)"/></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class='container align-center'>
                        <div id='ctaPortfolio'>
                            <a href='mailto:contact@alvencapital.com?subject=[Alven Capital Website] pitch&body=Please tell us about your startup. %0AYou can join a lightweight presentation'>
                                <span>
                                    Could this be you&nbsp;?
                                    <span class='btn-invert'>Send your pitch</span>
                                </span>
                            </a>
                        </div>
                        <a href='#' class='btn'>Browse all companies</a>
                    </div>
                </section>

                <section class='theme-we'>
                    <h2 class='section-title'>Who we are</h2>
                    <strong class='subtitle'>A sticky and professionnal team</strong>
                    <div class='container'>
                        <div class='section-header'>
                            <p>Alven Capital relies on a <a href='#'>strong team of passionate professionals</a> of the venture capital world.<br>
                            Thanks to its lean organization, Alven Capital is highly responsive both in relation to new investments and to day-to-day management of portfolio companies. By the way look at our  <a href='#'>investments thesis</a> and <a href='#'>the process to pitch us</a></p>
                        </div>
                    </div>
                    <div class='container overflow-hidden'>
                        <div class='container-small container-team'>
                            <div class='wrapper-btn-glob btn-prev'>
                                <a href='#' class='btn-arrow-only left'>Profil précédent</a>
                            </div>
                            <div class='wrapper-btn-glob btn-next'>
                                <a href='#' class='btn-arrow-only'>Profil suivant</a>
                            </div>
                            <ul class='team'>
                                <li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/guillaume-aubin.jpg' alt='Guillaume Aubin'>
                                        <span class='infos'>
                                            <span class='name'>Guillaume Aubin</span>
                                            <span class='function'>Managing Partner</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo risus, ullamcorper et ultrices malesuada, ornare vel sem. Phasellus eu nulla sed lectus malesuada sagittis.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/charles-letourneur.jpg' alt='Charles Letourneur'>
                                        <span class='infos'>
                                            <span class='name'>Charles Letourneur</span>
                                            <span class='function'>Managing Partner</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam quis erat maximus, facilisis ex sed, bibendum tellus. Vestibulum accumsan dolor a arcu mollis sodales. Mauris varius nulla ac leo condimentum, in feugiat lacus maximus. Duis et ultricies mi, sed sodales est. Suspendisse potenti. Mauris imperdiet, odio vel auctor laoreet, risus nisi eleifend lacus, at hendrerit neque elit non velit. Ut mattis laoreet velit in faucibus. Nunc fermentum ut odio at lobortis. Ut quis ex nibh. Vivamus facilisis ipsum sit amet posuere mattis. Donec a nulla congue, sagittis ex ut, imperdiet lectus. Suspendisse potenti. Praesent finibus ornare orci, in cursus ipsum mollis at.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/jeremy-uzan.jpg' alt='Jérémy Uzan'>
                                        <span class='infos'>
                                            <span class='name'>Jérémy Uzan</span>
                                            <span class='function'>Partner</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Passionné de technologies et d’Internet en particulier, diplômé de l’université Pierre et Marie Curie en Informatique, et titulaire d’un Master en Finance de l’Institut Mines-Telecom, Jeremy Uzan découvre le métier du venture capital au sein de l’équipe d’investissement de SGAM Private Equity. En 2005 il rejoint Clipperton Finance, banque d’affaires dédiée aux jeunes entreprises en forte croissance. Pendant près de 3 années, en tant qu’Associate, il accompagne dans leur développement plusieurs sociétés de croissance, notamment dans l’Internet, dont certaines deviendront des leaders nationaux et internationaux. Jeremy a rejoint l’équipe d’Alven Capital en 2008.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/raffi-kamber.jpg' alt='Raffi Kamber'>
                                        <span class='infos'>
                                            <span class='name'>Raffi Kamber</span>
                                            <span class='function'>Partner</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/rodolphe-menegaux.jpg' alt='Rodolphe Menegaux'>
                                        <span class='infos'>
                                            <span class='name'>Rodolphe Menegaux</span>
                                            <span class='function'>Partner</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/francois-meteyer.jpg' alt='François Meteyer'>
                                        <span class='infos'>
                                            <span class='name'>François Meteyer</span>
                                            <span class='function'>Investment manager</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/julie-brachilon.jpg' alt='Julie Brachilon'>
                                        <span class='infos'>
                                            <span class='name'>Julie Brachilon</span>
                                            <span class='function'>CFO</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/celine-ribero.jpg' alt='Céline Ribero'>
                                        <span class='infos'>
                                            <span class='name'>Céline Ribero</span>
                                            <span class='function'>Administration</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><li class='col-2'>
                                    <a class='team-member' href='#'>
                                        <img src='img/team/romain-nervil.jpg' alt='Romain Nervil'>
                                        <span class='infos'>
                                            <span class='name'>Romain Nervil</span>
                                            <span class='function'>Content, Marketing &amp; Community Manager</span>
                                        </span>
                                    </a>
                                    <ul class='social'>
                                        <li>
                                            <a href='#' class='icon-linkedin' target='_blank'>Linkedin</a>
                                        </li><li>
                                            <a href='#' class='icon-twitter' target='_blank'>Twitter</a>
                                        </li>
                                    </ul>
                                    <div class='desc'>
                                        <a class='btn-cross' href='#'>Close</a>
                                        <ul class='btn-desc'>
                                            <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                            <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                        </ul>
                                        <p>Maecenas vulputate mauris libero, nec convallis magna tempus convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ligula diam, dapibus a nulla non, posuere blandit sem. Etiam nec fringilla purus. Donec orci erat, lobortis id odio vel, laoreet euismod nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut sapien eros, interdum sed venenatis non, dapibus at augue. Donec in justo ipsum. Nam blandit elit libero, quis porta neque consectetur et. Integer enim dui, hendrerit ut consectetur vitae, blandit dictum odio. Pellentesque feugiat orci in nisi dignissim, a venenatis dui suscipit. Maecenas vel libero sed nunc aliquet convallis eu semper eros. Sed ut velit mi. Duis suscipit porttitor ornare.</p>
                                        <ul class='social social-desc'>
                                            <li>
                                                <a href='#' target='_blank'><span class='icon-linkedin'></span>Linkedin profile</a>
                                            </li><li>
                                                <a href='#' target='_blank'><span class='icon-twitter'></span>Twitter profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <div class='content-desc-responsive'>

                            </div>
                        </div>
                    </div>
                </div>
                <div class='theme-gold'>
                    <div class='contact-us'>
                        <div class='container'>
                            <h2 class='section-title'>Contact us</h2>
                            <strong class='subtitle'>Get in touch with us</strong>
                            <div class='grid wrapper-interactive-blocks'>
                                <div class='col-4 align-right interactive-block'>
                                    <h3>Pitch us !</h3>
                                    <p>Please make sure you answer the  following questions : What is the shortest way to describe your project&nbsp;?</p>
                                    <button class='btn btn-left open-form'>Send your pitch</button>
                                    <form action='#' method='post' class='align-left form-to-open'>
                                        <fieldset>
                                            <legend class='active'>Let's <span>Introduce yourself</span></legend>
                                            <section class='form-section'>
                                                <div>
                                                    <input type='text' name='firstname1' id='firstname1' required class='form-elt'>
                                                    <label for='firstname1'>Your firstname</label>
                                                </div><div>
                                                    <input type='text' name='lastname1' id='lastname1' required class='form-elt'>
                                                    <label for='lastname1'>Your lastname</label>
                                                </div><div class='large'>
                                                    <input type='email' name='email1' id='email1' required class='form-elt'>
                                                    <label for='email1'>Your email</label>
                                                </div>
                                            </section>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Send us <span>Your amazing pitch</span></legend>
                                            <section class='form-section'>
                                                <div class='full'>
                                                    <input type='file' name='pitchfile' id='pitchfile' class='form-elt'><label for='pitchfile'>
                                                        Upload your file
                                                    </label><span class='form-desc'>
                                                        a lightweight .pdf, .doc, .ptt, ...
                                                    </span>
                                                </div>
                                                <span class='form-title'>Or</span>
                                                <div class='full'>
                                                    <input type='url' name='pitchurl' id='pitchurl'><label for='pitchurl' class='form-elt'>
                                                        Send us your link
                                                    </label><span class='form-desc'>
                                                        a web page which describe your product or service
                                                    </span>
                                                </div>
                                                <span class='form-title'>And</span>
                                                <div class='full'>
                                                    <textarea name='pitchtext' id='pitchtext' required class='form-elt'></textarea>
                                                    <label for='ptichtext'>Write us a few word there about what you expect from us</label>
                                                </div>
                                            </section>
                                        </fieldset>
                                        <button type='submit' name='submitpitch' class='btn-invert'>Confirm</button>
                                    </form>
                                </div><div class='col-4 interactive-block'>
                                    <h3>General questions</h3>
                                    <p>You have a general question about our company, you are an investors how want to have some more informations</p>
                                    <button class='btn open-form'>General questions</button>
                                    <form action='#' method='post' class='align-left form-to-open'>
                                        <fieldset>
                                            <legend class='active'>Let's <span>Introduce yourself</span></legend>
                                            <section class='form-section'>
                                                <div>
                                                    <input type='text' name='firstname2' id='firstname2' required class='form-elt'>
                                                    <label for='firstname2'>Your firstname</label>
                                                </div><div>
                                                    <input type='text' name='lastname2' id='lastname2' required class='form-elt'>
                                                    <label for='lastname2'>Your lastname</label>
                                                </div><div class='large'>
                                                    <input type='email' name='email2' id='email2' required class='form-elt'>
                                                    <label for='email2'>Your email</label>
                                                </div>
                                            </section>
                                        </fieldset>
                                        <fieldset>
                                            <legend>We're ready to read: <span>What would you like to know?</span></legend>
                                            <section class='form-section'>
                                                <div class='full'>
                                                    <textarea id='msg' name='msg' required class='form-elt'></textarea>
                                                    <label for='msg'>Write us a few word there about what you expect from us</label>
                                                </div>
                                            </section>
                                        </fieldset>
                                        <button type='submit' name='submitcontact' class='btn-invert'>Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='quotes'>
                        <div class='container'>
                            <div class='grid'>
                                <div class='col-4 quote'>
                                    <div class='img-quote'>
                                        <img src='img/testimonials/nicolas-dessaigne.png'>
                                    </div>
                                    <blockquote>
                                        <p>Alven starts with Al just like Algolia, this can't be just a coincidence...</p>
                                        <footer>Nicolas Dessaigne, CEO</footer>
                                    </blockquote>
                                </div><div class='col-4 quote'>
                                    <div class='img-quote'>
                                        <img src='img/testimonials/karl-lagerfeld.png'>
                                    </div>
                                    <blockquote>
                                        <p>The minute you believe that the past was better, your present becomes second-hand, and you yourself become vintage</p>
                                        <footer>Karl Lagerfeld</footer>
                                    </blockquote>
                                </div><div class='col-4 quote'>
                                    <div class='img-quote'>
                                        <img src='img/testimonials/katia-beauchamp.png'>
                                    </div>
                                    <blockquote>
                                        <p>It’s really important to have a product that’s geared towards not the people you’re pitching to</p>
                                        <footer>Katia Beauchamp, CEO</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <footer role='contentinfo' id='footer'>
            <div class='container'>
                <div class='container-small'>
                    <div class='grid'>
                        <div class='col-3 menu-small'>
                            <span class='menu-title'>Think, read, exchange</span>
                            <span class='menu-subtitle'>alven online magazine</span>
                            <ul>
                                <li><a href='#'>About us</a></li>
                                <li><a href='#'>Our investment thesis</a></li>
                                <li><a href='#'>The process to pitch us</a></li>
                            </ul>
                        </div><div class='col-3 menu-small'>
                            <span class='menu-title'>Who we are</span>
                            <span class='menu-subtitle'>a stichy & professionnal team</span>
                            <ul>
                                <li><a href='#'>Who we are</a></li>
                                <li><a href='#'>About us</a></li>
                                <li><a href='#'>Our investment thesis</a></li>
                                <li><a href='#'>The process to pitch us</a></li>
                            </ul>
                        </div><div class='col-2 menu-small'>
                            <span class='menu-title'>Portfolio</span>
                            <span class='menu-subtitle'>what we fund, what we funded</span>
                            <ul>
                                <li>
                                    <a href='#'>Portfolio</a>
                                    <ul>
                                        <li><a href='#'>Actual investments</a></li>
                                        <li><a href='#'>Past investments</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div><div class='col-2 menu-small'>
                            <span class='menu-title'>Contact us</span>
                            <span class='menu-subtitle'>get in touch with us</span>
                            <ul>
                                <li><a href='#'>Send us your pitch</a></li>
                                <li><a href='#'>General questions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src='js/isMobile.min.js'></script>
        <script src='js/jquery-3.0.0.min.js'></script>

        <script src='js/TweenMax.min.js'></script>
        <script src='js/splitText.min.js'></script>
        <script src='js/draggable.min.js'></script>
        <script src='js/ThrowPropsPlugin.min.js'></script>
        <script src='js/ScrollToPlugin.min.js'></script>

        <script src='js/ScrollMagic.min.js'></script>
        <script src='js/animation.gsap.js'></script>
        <!--<script src='js/scrollmagic-debug.js'></script>-->

        <script src='js/script.js'></script>

    </body>

</html>
