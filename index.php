<?php

require realpath('TwitterAPIExchange.php');

/*
 * Set access tokens here
 * see: https://dev.twitter.com/apps/
 */
$APISettings = [
    'oauth_access_token'        => "OAUTH_ACCESS_TOKEN",
    'oauth_access_token_secret' => "OAUTH_ACCESS_TOKEN_SECRET",
    'consumer_key'              => "CONSUMER_KEY",
    'consumer_secret'           => "CONSUMER_SECRET"
];

// User name for fetching the last tweets
$screen_name = '@TWITTER_USERNAME';

// How many tweets will be fetched?
$tweetCount = 3;

// API Url
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// Parameters for querying the API
$getfield = "?screen_name=$screen_name&count=$tweetCount&trim_user=false";

// Instantiate the class
$twitter = new TwitterAPIExchange($APISettings);
$data = $twitter->setGetfield($getfield)
    ->buildOauth($url, 'GET')
    ->performRequest();

// Decode response
$tweets = json_decode($data);

// Print out with custom styles
foreach ($tweets as $tweet) {
    echo '
        <div class="tweet-box">
            <i class="fa fa-twitter"></i>
            <em>
                '.$tweet->text.'
            </em>
        </div>
    ';
}
