@extends('layouts.default')

@section('title', __('policy.cookies'))

@section('content')
    <h1 class="font-weight-bold">{{ __('policy.cookies') }}</h1>

    <p class="text-muted my-3">{{ __('policy.updated') }}: {{ __('policy.date_cookies') }}</p>

    <p>{{ config('app.name') }} ("us", "we", or "our") uses cookies on {{ request()->getHost() }} (the "Website"). By using the Website, you consent to the use of cookies.</p>
    <p>("You", "your") means the individual accessing or using the Website, or a company, or any legal entity on behalf of which such individual is accessing or using the Website, as applicable.</p>
    <p>This Cookies Policy explains what Cookies are and how We use them. You should read this policy so You can understand what type of cookies We use, or the information We collect using Cookies and how that information is used.</p>
    <p>Cookies do not typically contain any information that personally identifies a user, but personal information that we store about You may be linked to the information stored in and obtained from Cookies. For further information on how We use, store and keep your personal data secure, see our <a href="{{ route('privacy') }}">Privacy Policy</a> and <a href="{{ route('terms') }}">Terms of Service</a>.</p>
    <p>We do not store sensitive personal information, such as mailing addresses, account passwords, etc. in the Cookies We use.</p>

    <h5 class="font-weight-bold">What are cookies</h5>

    <p>Cookies are small pieces of text sent by your web browser by a website you visit. A cookie file is stored in your web browser and allows the Website or a third-party to recognize you and make your next visit easier and the Website more useful to you.</p>
    <p>Cookies can be "persistent" or "session" cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p>

    <h5 class="font-weight-bold">How we use cookies</h5>

    <p>When you use and access the Website, we may place a number of cookies files in your web browser.</p>
    <p>We use cookies for the following purposes: to enable certain functions of the Website, to provide analytics, to store your preferences, to enable advertisements delivery, including behavioral advertising.</p>
    <p>We use both session and persistent Cookies for the purposes set out below:</p>

    <table class="table table-bordered">
        <thead class="thead-light text-center">
            <tr class="text-nowrap">
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Administered by</th>
                <th scope="col">Purpose</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Necessary/Essential cookies</td>
                <td>Session Cookies</td>
                <td>Us</td>
                <td>These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</td>
            </tr>
            <tr>
                <td>Functionality/Preferences cookies</td>
                <td>Persistent Cookies</td>
                <td>Us</td>
                <td>These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</td>
            </tr>
            <tr>
                <td>Analytics and Performance cookies</td>
                <td>Session/Persistent Cookies</td>
                <td>Thid-Parties</td>
                <td>These cookies are used to collect information about traffic to our Website and how users use our Website. The information gathered does not identify any individual visitor. The information is aggregated and anonymous. It includes the number of visitors to our Website, the websites that referred them to our Website, the pages they visited on our Website, what time of day they visited our Website, whether they have visited our Website before, and other similar information. We use this information to help operate our Website more efficiently, to gather broad demographic information and to monitor the level of activity on our Website.</td>
            </tr>
            <tr>
                <td>Targeting and Advertising Cookies</td>
                <td>Persistent Cookies</td>
                <td>Third-Parties</td>
                <td>These Cookies track your browsing habits to enable Us to show advertising which is more likely to be of interest to You. These Cookies use information about your browsing history to group You with other users who have similar interests. Based on that information, and with Our permission, third party advertisers can place Cookies to enable them to show adverts which We think will be relevant to your interests while You are on third party websites.</td>
            </tr>
            <tr>
                <td>Social Media Cookies</td>
                <td>Persistent</td>
                <td>Third-Parties</td>
                <td>We may also use various third parties Cookies to report usage statistics of the Website, deliver advertisements on and through the Website, and so on. These Cookies may be used when You share information using a social media networking website such as Facebook, Instagram, Twitter, and so on.</td>
            </tr>
        </tbody>
    </table>

    <h5 class="font-weight-bold">Third-party cookies</h5>

    <p>In addition to our own cookies, we may also use various third-parties cookies to report usage statistics of the Website, deliver advertisements on and through the Website, and so on.</p>

    <h5 class="font-weight-bold">What are your choices regarding cookies</h5>

    <p>If You prefer to avoid the use of Cookies on the Website, first You must disable the use of Cookies in your browser and then delete the Cookies saved in your browser associated with this website. You may use this option for preventing the use of Cookies at any time.</p>
    <p>If You do not accept Our Cookies, You may experience some inconvenience in your use of the Website and some features may not function properly.</p>
    <p>If You'd like to delete Cookies or instruct your web browser to delete or refuse Cookies, please visit the help pages of your web browser.</p>

    <ul>
        <li>For the Chrome web browser, please visit this page from Google: <a href="https://support.google.com/accounts/answer/32050">https://support.google.com/accounts/answer/32050</a></li>
        <li>For the Internet Explorer web browser, please visit this page from Microsoft: <a href="http://support.microsoft.com/kb/278835">http://support.microsoft.com/kb/278835</a></li>
        <li>For the Firefox web browser, please visit this page from Mozilla: <a href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></li>
        <li>For the Safari web browser, please visit this page from Apple: <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></li>
    </ul>

    <p>For any other web browser, please visit your web browser's official web pages.</p>
    <p>You can also control and/or delete cookies of your choice, please see <a href="https://aboutcookies.org/">https://aboutcookies.org/</a></p>

    <h5 class="font-weight-bold">Where can your find more information about cookies</h5>

    <p>You can learn more about cookies at the following third-party websites:</p>

    <ul>
        <li>AllAboutCookies: <a href="http://www.allaboutcookies.org/">http://www.allaboutcookies.org/</a></li>
        <li>Network Advertising Initiative: <a href="http://www.networkadvertising.org/">http://www.networkadvertising.org/</a></li>
    </ul>

    <h5 class="font-weight-bold">Contact Us</h5>

    <p>If you have any questions about this Cookie Policy, You can contact us:</p>

    <ul>
        <li>By email: support{{ '@' . request()->getHost() }}</li>
        <li>By visiting this page on our website: <a href="{{ route('contact') }}">Click here</a></li>
    </ul>
@endsection