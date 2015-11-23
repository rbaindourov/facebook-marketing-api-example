# facebook-marketing-api-example
##Requirements: Webserver running PHP 5.x, e.g. Apache/XAMPP/MAMP; Composer

I was completely surprised that the documentation on the [QuickStart](https://developers.facebook.com/docs/marketing-api/quickstart) didn't have any functional code examples.

So I created this repo to help other developers.

Check out the repo into a SSL'ed hosted domain directory.
This will need to be a public facing IP, most likely.
I never got far on my localhost.

Run composer install command to grab dependencies as per your environment setup.

Enter values for app_id, app_secret, URL, page_id in the conf.json file.

Make sure you have manage_pages permissions, and the URL is entered in your App if you want to grab leadgen_forms.

Point your browser at getAccessToken.php, authenticate, enjoy.

I didn't test this code yet, so feel free to point out any mistakes. Slapped it together pretty quickly from my actual work project.


Thanks!

Robert Baindourov
