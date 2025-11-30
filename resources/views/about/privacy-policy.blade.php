@extends('layouts.app')

@section('title', 'Privacy Policy - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 4rem;">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
        <p class="text-lg text-gray-600">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 prose prose-lg max-w-none">
        <div class="space-y-8">
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
                <p class="text-gray-700 leading-relaxed">
                    Welcome to Community Hub. We are committed to protecting your privacy and ensuring the security of your personal information. 
                    This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform.
                </p>
            </section>

            <!-- Information We Collect -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Information We Collect</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">2.1 Personal Information</h3>
                        <p class="text-gray-700 leading-relaxed">
                            When you register for an account, we collect the following information:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4 mt-2">
                            <li>Full name</li>
                            <li>Email address</li>
                            <li>Contact number</li>
                            <li>Voters ID (for verification purposes)</li>
                            <li>Address</li>
                            <li>Password (encrypted and securely stored)</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">2.2 Usage Information</h3>
                        <p class="text-gray-700 leading-relaxed">
                            We automatically collect information about how you interact with our platform, including:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4 mt-2">
                            <li>Reports and tickets you submit</li>
                            <li>Suggestions and comments you post</li>
                            <li>Pages you visit and features you use</li>
                            <li>Device information and browser type</li>
                            <li>IP address and location data</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- How We Use Your Information -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. How We Use Your Information</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    We use the information we collect for the following purposes:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>To provide and maintain our services</li>
                    <li>To process and respond to your reports and suggestions</li>
                    <li>To communicate with you about your account and our services</li>
                    <li>To improve our platform and user experience</li>
                    <li>To ensure the security and integrity of our platform</li>
                    <li>To comply with legal obligations and protect our rights</li>
                    <li>To send you important announcements and updates (with your consent)</li>
                </ul>
            </section>

            <!-- Information Sharing -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Information Sharing and Disclosure</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li><strong>With Barangay Staff:</strong> Your reports and suggestions may be shared with authorized staff members to address your concerns.</li>
                    <li><strong>Legal Requirements:</strong> We may disclose information if required by law or to protect our rights and safety.</li>
                    <li><strong>Service Providers:</strong> We may share information with trusted service providers who assist us in operating our platform, subject to confidentiality agreements.</li>
                    <li><strong>With Your Consent:</strong> We may share your information with your explicit consent.</li>
                </ul>
            </section>

            <!-- Data Security -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Data Security</h2>
                <p class="text-gray-700 leading-relaxed">
                    We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, 
                    alteration, disclosure, or destruction. This includes:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4 mt-2">
                    <li>Encryption of sensitive data</li>
                    <li>Secure password storage using industry-standard hashing</li>
                    <li>Regular security assessments and updates</li>
                    <li>Access controls and authentication measures</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-4">
                    However, no method of transmission over the internet or electronic storage is 100% secure. While we strive to protect your information, 
                    we cannot guarantee absolute security.
                </p>
            </section>

            <!-- Your Rights -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Your Rights</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You have the following rights regarding your personal information:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li><strong>Access:</strong> You can request access to your personal information we hold.</li>
                    <li><strong>Correction:</strong> You can update or correct your personal information through your profile settings.</li>
                    <li><strong>Deletion:</strong> You can request deletion of your account and personal information, subject to legal and operational requirements.</li>
                    <li><strong>Objection:</strong> You can object to certain processing of your information.</li>
                    <li><strong>Data Portability:</strong> You can request a copy of your data in a structured format.</li>
                </ul>
            </section>

            <!-- Cookies and Tracking -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies and Tracking Technologies</h2>
                <p class="text-gray-700 leading-relaxed">
                    We use cookies and similar tracking technologies to enhance your experience on our platform. Cookies help us remember your preferences, 
                    maintain your session, and analyze how you use our services. You can control cookie preferences through your browser settings.
                </p>
            </section>

            <!-- Children's Privacy -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Children's Privacy</h2>
                <p class="text-gray-700 leading-relaxed">
                    Our platform is not intended for individuals under the age of 18. We do not knowingly collect personal information from children. 
                    If you believe we have collected information from a child, please contact us immediately.
                </p>
            </section>

            <!-- Changes to Privacy Policy -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Changes to This Privacy Policy</h2>
                <p class="text-gray-700 leading-relaxed">
                    We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page 
                    and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.
                </p>
            </section>

            <!-- Contact Us -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Contact Us</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    If you have any questions about this Privacy Policy or our data practices, please contact us:
                </p>
                <div class="bg-gray-50 rounded-lg p-6">
                    <p class="text-gray-700"><strong>Email:</strong> info@communityhub.ph</p>
                    <p class="text-gray-700"><strong>Phone:</strong> (02) 123-4567</p>
                    <p class="text-gray-700"><strong>Address:</strong> Barangay Hall</p>
                    <p class="text-gray-700"><strong>Office Hours:</strong> Mon-Fri: 8:00 AM - 5:00 PM</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Back to Home -->
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Home
        </a>
    </div>
</div>
@endsection

