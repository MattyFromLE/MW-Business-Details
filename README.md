# MW Business Details
What can MW Business Details do to help?

MW Business Details supports 13 shortcodes to speed up your development time. 

Wrap the below in php tags in your template OR simply take the content between the square brackets, and add to your content box - like so: [mainNumber id="enter-page-name-for-tracking"]

# Company Name	
echo do_shortcode('[companyName]')
Pulls out the "name" of your Wordpress website.
# Company Number	echo do_shortcode('[companyNumber]')
Pulls out your Company Number.
# Company Logo	echo do_shortcode('[companyLogo]')
Set your logo on the "Company Information" tab - then use this shortcode in your header file.
# Main Number	echo do_shortcode('[mainNumber id="enter-page-name-for-tracking"]')
This will pull out your main telephone number out within an '< a >' tag - with a unique ID for tracking clicks with Google Analytics.
# E-Mail Address	echo do_shortcode('[email id="enter-page-name-for-tracking"]')
This will pull out your e-mail address out, inside an '< a >' tag, with a mailto: dynamically set.
# Fax Number	echo do_shortcode('[faxNumber]')
Simply pulls out your fax number, if you have one. Y'know - this isn't 1995.
# Alternative Number	echo do_shortcode('[altNumber id="enter-page-name-for-tracking"]')
Alternative Number - to be used if you have for example, a landline, and a mobile phone number.
# Main Address	echo do_shortcode('[addressSchema id="enter-page-name-for-tracking" schema="hide" ]')
This will pull your address out only. Ensure you set a unique ID for Schema & validation. You can pass "show", or "hide" to toggle schema tags.
# Second Address	echo do_shortcode('[secondAddress]')
Simply decide if you want to show another address, and use the shortcode to show the address
# Everything 
Excludes Opening Times	echo do_shortcode('[contactPage id="enter-page-name-for-tracking"]')
This will pull out: All telephone numbers, full address and social links into a div. Ensure you set a unique ID.
# Google Map	echo do_shortcode('[mapWrapper]')
BEFORE using this shortcode, please remember to fill in the "Google Maps" tab. Use this anywhere that you want to show a map.
# Opening Times	echo do_shortcode('[openingTimes]')
Displays your opening times in the chosen format. Go to the Opening Times Tab to change.
# Social Links	echo do_shortcode('[socialLinks id="enter-page-name-for-tracking"]')
If you want to pull your social links into a different block - use this.