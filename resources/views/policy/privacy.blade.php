@extends('layouts.default')

@section('title', __('policy.privacy'))

@section('content')
    <h1 class="font-weight-bold">{{ __('policy.privacy') }}</h1>

    <p class="text-muted my-3">{{ __('policy.updated') }}: {{ __('policy.date') }}</p>

    <p>{!! __('policy.string-1') !!}</p>

    <h4>{{ __('policy.commitment') }}</h4>

    <ul>
        <li>{{ __('policy.string-2') }}</li>
        <li>{{ __('policy.string-3') }}</li>
        <li>{{ __('policy.string-4') }}</li>
    </ul>

    <p>{{ __('policy.string-5') }}</p>
    <p>{{ __('policy.string-6') }}</p>

    <ol type="a">
        <li>{{ __('policy.string-7') }}</li>
        <li>{{ __('policy.string-8') }}</li>
        <li>{{ __('policy.string-9') }}</li>
        <li>{{ __('policy.string-10') }}</li>
        <li>{{ __('policy.string-11') }}</li>
        <li>{{ __('policy.string-12') }}</li>
    </ol>

    <h4>1. {{ __('policy.notice') }}</h4>

    <p>{{ __('policy.string-13') }}</p>

    <h4>2. Usage</h4>

    <p>We use your personal information for the following purposes:</p>

    <ul>
        <li>To provide you information that will allow you to use our services</li>
        <li>To automatically customize your documents with your information</li>
        <li>To alert you of software upgrades, updates, discounts or other services from {{ config('app.name') }}</li>
    </ul>

    <p>We collect your email when you sign up in order to send you informational communications about {{ config('app.name') }}. We also collect your email to send you our promotional offers.</p>
    <p>We may also collect your name, language, currency, operating system, document searched and country information for a better experience with {{ config('app.name') }} products/services.</p>
    <p>When you signup with us, we collect your email in order to communicate with you. We also collect your phone number in order to contact you in case these emails bounce back because of a typo in your email address and if we cannot figure out what the correct email address is.</p>
    <p>We also contact the phone number that is provided if we suspect that the cardholder’s credit card information has been compromised, i.e used in a fraudulent way.</p>
    <p>We also use our clients’ email in order to notify of the release of updated versions of the software, new services or promotional offers.</p>

    <h4>3. Consent</h4>

    <p>When you provide your personal information, you consent that it can be used for the above purposes and that {{ config('app.name') }} is an authorized holder of such information. If you choose not to register or provide personal information, you can still use our website but you will not be able to receive additional services or access to certain areas that require registration. When you activate your account, you are providing your consent to occasionally receive information from us. In each communication from us, you will have the opportunity to unsubscribe from further communications; alternatively, you may contact us to express your choices at the address provided at the bottom of this page.</p>

    <h4>4. Access to your information</h4>

    <p>You are entitled to review the personal information you have provided us and ensure that it is accurate and current at all times. To review or update this information simply review your account settings area or request that we send you this information.</p>

    <h4>5. Security of information</h4>

    <p>{{ config('app.name') }} is strongly committed to protecting your information and ensuring that your choices are honored. We have taken strong security measures to protect your data from loss, misuse, unauthorized access, disclosure, alteration, or destruction. All sensitive data is stored behind multiple firewalls on secure servers with restricted employee access.</p>
    <p>We guarantee that all e-commerce transactions follow the latest security measures and use the best available technologies. Secure Sockets Layer (SSL) technology is employed when you place online orders or transmit sensitive information. SSL is one of the safest methods of passing information over the Internet.</p>

    <h4>6. Retention of information</h4>

    <p>We retain information as long as it is necessary to provide the services requested by you and others, subject to any legal obligations to further retain such information. Information associated with your account will generally be kept until it is no longer necessary to provide the services or until you ask us to delete it or your account is deleted whichever comes first. Additionally, we may retain information from deleted accounts to comply with the law, prevent fraud, resolve disputes, troubleshoot problems, assist with investigations, enforce <a href="{{ route('terms') }}">the Terms of Use</a>, and take other actions permitted by law. The information we retain will be handled in accordance with this Privacy Policy. Finally, your data could also be stored for sales statistical purposes.</p>

    <h4>7. Cookies</h4>

    <p>You can read more about how we use cookies on our <a href="{{ route('cookies') }}">Cookie Policy</a>.</p>

    <h4>8. EU and EEA Users’ Rights</h4>

    <p>If you are habitually located in the European Union or European Economic Area, you have the right to access, rectify, download or erase your information, as well as the right to restrict and object to certain processing of your information. While some of these rights apply generally, certain rights apply only in certain limited circumstances. We describe these rights below:</p>
    <p class="font-italic">You have the right to access your personal data and, if necessary, have it amended or deleted or restricted. In certain instances, you may have the right to the portability of your data. You can also ask us to not send marketing communications and not to use your personal data when we carry out profiling for direct marketing purposes. You can opt-out of receiving email newsletters and other marketing communications by following the opt-out instructions provided to you in those emails. Transactional account messages will be unaffected if you opt-out from marketing communications.</p>

    <h4>9. What we do with the Information you share</h4>

    <p>Your information is never shared outside the company without your permission. Inside the company, data is stored behind multiple firewalls on secure servers with restricted user access.</p>
    <p>When you register to our website, you are asked to provide your contact information, including a valid email address. We use this information to send you updates about {{ config('app.name') }} order confirmations and information about our services. When you order from us, we ask for your credit card number and billing address. We use this information only to bill you for the product(s) you ordered at that time.</p>
    <p>We may on occasion require the help of other companies to provide limited services on our behalf, such as packaging, shipping, and delivery, customer support and processing event registrations. We will only provide such companies with the information required for them to perform these services; these service providers are bound by strict privacy policies and are prohibited from using your information for any other purpose.</p>
    <p>In very rare instances {{ config('app.name') }} may disclose your personal information, without notice, only if required to do so by law or in the good faith belief that such action is necessary to: (a) conform to the edicts of the law or comply with legal process served on {{ config('app.name') }} or the site; (b) protect and defend the rights or property of {{ config('app.name') }} and its family of websites and properties; and (c) act in urgent circumstances to protect the personal safety of users of {{ config('app.name') }}, its websites, or the public.</p>

    <h4>10. How to opt-out</h4>

    <p>We provide users with the opportunity to opt-out from receiving updates on our products, newsletters and other communications from us. You can opt-out by clicking on the link provided in our electronic mailings or by contacting us at the address at the bottom of this page.</p>

    <h4>11. Does {{ config('app.name') }} privacy policy apply to linked websites?</h4>

    <p>Our Privacy Policy applies solely to information collected on our website or through our resource. The Site contains links to web sites of third parties. {{ config('app.name') }} is not responsible for the actions of these third parties, including their privacy practices and any content posted on their web sites. We encourage you to review their privacy policies to learn more about what, why and how they collect and use personal information. {{ config('app.name') }} adheres to industry-recognized standards to secure any personal information in our possession, and to secure it from unauthorized access and tampering.</p>
    <p>However, as is true with all online actions, it is possible that third parties may unlawfully intercept transmissions of personal information, or other users of the Site may misuse or abuse your personal information that they may collect from the Site.</p>
    <p>{{ config('app.name') }} uses third-party advertising companies to serve our ads on the Site. Please review our <a href="{{ route('cookies') }}">Cookie Policy</a> for all details. These third-party advertising companies employ cookie and 1x1 pixel, gifs or web beacons to measure and improve the effectiveness of ads for their clients. To do so, these companies may use anonymous information about your visits to our website and other websites but will not collect any information which can personally identify you or can be linked to you. This information can include: date/time of banner ad shown, the banner ad that was shown, their cookie, and the IP address. This information can also be used for online preference marketing purposes.</p>
    <p>If you want to prevent a third-party advertiser from collecting data, currently you may either visit each ad network's web site individually and opt-out or visit the NAI gateway opt-out site to opt-out of all network advertising cookies. <a href="https://optout.networkadvertising.org/">Click here</a> for the NAI gateway opt-out site. This site will also allow you to review the third-party advertising companies' privacy policies.</p>

    <h4>12. Changes to this policy</h4>

    <p>If we make changes to our Privacy Policy, we will post these changes here so that you are always aware of what information we collect, how we use it and under what circumstances, if any, we disclose it. If at any point we decide to use your information in a manner different from that stated at the time it was collected, we will notify you by email.</p>

    <h4>13. Enforcement of policy</h4>

    <p>If for some reason you believe {{ config('app.name') }} has not adhered to these principles, please notify us and we will do our best to promptly make corrections.</p>

    <h4>14. Questions or comments</h4>

    <p>If you have questions or comments about this privacy policy, please email us:</p>
    <p class="mb-1">{{ config('app.name') }}</p>
    <p>support{{ '@' . request()->getHost() }}</p>
    <p>For information about how to contact {{ config('app.name') }} please visit our <a href="{{ route('contact') }}">contact page</a>.</p>
@endsection