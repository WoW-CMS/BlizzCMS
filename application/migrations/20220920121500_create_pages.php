<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pages extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'content' => [
                'type' => 'MEDIUMTEXT'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => TRUE
            ],
            'views' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'meta_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => ''
            ],
            'meta_robots' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'index, follow'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('pages', false, ['ENGINE' => 'InnoDB']);

        $this->page_model->insert_batch([
            ['title' => 'Terms of service', 'content' => '<p>By accessing or using <strong>servername.com</strong> (the "Site") and its services (the "Services"), you (the "User") agree to comply with the terms and conditions governing the user\'s use of any areas of the site and affiliated services as set forth below.</p><h4><strong>Use of site</strong></h4><p>This site or any portion of the site as well as the services may not be reproduced, duplicated, copied, sold, resold, or otherwise exploited for any commercial purpose except as expressly permitted by servername.com. Servername reserves the right to refuse service in its discretion, without limitation, if servername believes the user conduct violates applicable law or is harmful to the interests of servername, other users of the site and the services or its affiliates.</p><h4><strong>Use of services</strong></h4><p>Servername.com is a non-profit project developed to imitate outdated game versions for educational purposes only. The site and the services do not support and do not provide any modification to game files. By using the site or the services, the user agrees to take responsibility to follow game\'s eula.</p><h4><strong>Distribution</strong></h4><p>Servername.com does not support distribution of any game clients. Download links on the site constitute mirrors of external sites for educational purposes.</p><h4><strong>Site account</strong></h4><p>The user may register a regular account and password for the service for free. You are responsible for all activity under your account, associated accounts, and passwords. The site is not responsible for unauthorised access to your account, and any loss of virtual items associated with it.</p><h4><strong>Events, videos and community creations</strong></h4><p>Upon registering an account, you agree that your account or characters may be included in any events, streams or videos for promotion or review purposes.</p><h4><strong>Access to the site and services</strong></h4><p>Servername provides free and unlimited access to the site and the services.</p><h4><strong>Submission</strong></h4><p>Servername does not assume any obligation with respect to any submission and no confidential or fiduciary understanding or relationship is established by the site\'s receipt or acceptance of any submission. All submissions become the exclusive property of the site and its affiliates. The site and its affiliates may use any submission without restriction and the user shall not be entitled to any compensation.</p><h4><strong>Third-party content</strong></h4><p>Neither servername, nor its affiliates, nor any of their respective officers, directors, employees, or agents, nor any third party, including any provider/affiliate, or any other user of the site and services, guarantees the accuracy, completeness, or usefulness of any content, nor its merchantability or fitness for any particular purpose. In some instances, the content available through the site may represent the opinions and judgments of providers/affiliates or users. Servername and its affiliates do not endorse and shall not be responsible for the accuracy or reliability of any opinion, advice, or statement made on the site and the services by anyone other than authorised servername employees. Under no circumstances shall servername, or its affiliates, or any of their respective officers, directors, employees, or agents be liable for any loss, damage or harm caused by a user\'s reliance on information obtained through the site and the services. It is the responsibility of the user to evaluate the information, opinion, advice, or other content available through this site.</p><h4><strong>Disclaimers and limitation of liability</strong></h4><p>User agrees that use of the site and the services is at the user\'s sole risk. Neither servername, nor its affiliates, nor any of their respective officers, directors, employees, agents, third-party content providers, merchants, sponsors, licensors or the like (collectively, "Providers"], warrant that the site and the services will be uninterrupted or error-free; nor do they make any warranty as to the results that may be obtained from the use of the site and the services, or as to the accuracy, reliability, or currency of any information content, service, or merchandise provided through this site. The site and the services are provided by servername on an "As is" and "As available" basis. The site makes no representations or warranties of any kind, express or implied, as to the operation of the site, the information, content, materials or products, included on this site. To the full extent permissible by applicable law, the site disclaims all warranties, express or implied, including but not limited to, implied warranties of merchantability and fitness for a particular purpose. Servername will not be liable for any damages of any kind arising from the use of the site and the services, including but not limited to direct, indirect, incidental, punitive and consequential damages. Under no circumstances shall servername or any other party involved in creating, producing, or distributing the site and the services be liable for any direct, indirect, incidental, special, or consequential damages that result from the use of or inability to use the site and the services, including but not limited to reliance by the user on any information obtained from the site or that result from mistakes, omissions, interruptions, deletion of files or email, errors, defects, viruses, delays in operation or transmission, or any failure of performance, whether or not resulting from acts of god, communications failure, theft, destruction, or unauthorised access to the site\'s records, programs, or services. The user hereby acknowledges that these disclaimers and limitation on liability shall apply to all content, merchandise, and services available through the site and the services. In states that do not allow the exclusion of limitation or limitation of liability for consequential or incidental damages, the user agrees that liability in such states shall be limited to the fullest extent permitted by applicable law.</p><h4><strong>Termination of service</strong></h4><p>Servername reserves the right, in its sole discretion, to change, suspend, limit, or discontinue any aspect of the service and the services at any time. Servername may suspend or terminate any user\'s access to all or part of the site and the services, without notice, for any conduct that servername, in its sole discretion, believes is in violation of these terms and conditions.</p><h4><strong>Acknowledgement</strong></h4><p>By accessing or using the site and the services, the user agrees to be bound by these terms and conditions, including disclaimers. Servername reserves the right to make changes to the site and these terms and conditions, including disclaimers, at any time. If you do not agree to the provisions of this agreement or are not satisfied with the service, your sole and exclusive remedy is to discontinue your use of the service.</p><h4><strong>Privacy statement</strong></h4><p>Certain user information collected through the use of this website is automatically stored for reference. We track such information to perform internal research on our user\'s demographic interests and behaviour and to better understand, protect and serve our community of users. Payment or any other financial information is never submitted, disclosed or stored on the site and is bound to terms and conditions and privacy policy of our respective partners and/or payment processors. Basic user information (such as ip address, logs for using website interface and account management) may be disclosed to our partners in mutual efforts to counter potential illegal activities. Servername makes significant effort to protect submitted information to prevent unauthorised access to that information in its internal procedures and technology. However, we do not guarantee, nor should you expect, that your personal information and private communications will always remain private.</p>', 'slug' => 'terms', 'meta_robots' => 'index, follow'],
            ['title' => 'Privacy policy', 'content' => '<p>This privacy policy has been compiled to better serve those who are concerned with how their <strong>personally identifiable information</strong> (pii) is being used online. Pii, as used in us privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your personally identifiable information in accordance with our website.</p><h4><strong>What personal information do we collect from the people that visit website?</strong></h4><p>When registering on our site, as appropriate, you will be asked to enter your email address or other details to aid in identifying your account.</p><h4><strong>When do we collect information?</strong></h4><p>We collect information from you when you register on our site or enter information on our site.</p><h4><strong>How do we use your information?</strong></h4><p>We may use the information we collect from you when you register, surf the website, or use certain other site features in the following ways:</p><ul><li>To allow us to better service you regarding features or in responding to your support requests.</li><li>To send periodic emails regarding your account or other services.</li></ul><h4><strong>How do we protect visitor information?</strong></h4><p>Our website is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible. Information stored on the website is encrypted using various algorithms.</p><p>Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive information you supply is encrypted via secure socket layer (ssl) technology.</p><p>We implement a variety of security measures when a user registers an account, submits, or accesses their information, uses features to maintain the safety of your personal information.</p><h4><strong>Do we use cookies?</strong></h4><p>Yes. Cookies are small files that a site or its service provider transfers to your computer\'s hard drive through your web browser (if you allow) that enables the site\'s or service provider\'s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us automatically remember you for your next visit. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</p><p>We use cookies to:</p><ul><li>Understand and save user\'s preferences for future visits.</li></ul><p>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser (like internet explorer) settings. Each browser is a little different, so look at your browser\'s help menu to learn the correct way to modify your cookies.</p><h4><strong>If users disable cookies in their browser:</strong></h4><p>If you disable cookies, some features will be disabled. It will turn off some of the features that make your site experience more efficient and some of our services will not function properly.</p><p>Features that will be disabled</p><ul><li>Remember me feature</li></ul><h4><strong>Third party disclosure</strong></h4><p>We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information.</p><h4><strong>Third party links</strong></h4><p>We do not include or offer third party products or services on our website.</p><h4><strong>According to caloppa we agree to the following:</strong></h4><p>Users can visit our site anonymously</p><p>Once this privacy policy is created, we will add a link to it on our home page, or as a minimum on the first significant page after entering our website.</p><p>Our privacy policy link includes the word <strong>privacy</strong>, and can be easily be found on the page specified above.</p><p>Users will be notified of any privacy policy changes:</p><ul><li>On our privacy policy page</li></ul><p>Users are able to review change their personal information:</p><ul><li>By logging in to their account</li><li>By sending us a support ticket</li></ul><p>Users are able to request the removal of their information:</p><ul><li>By sending us an email</li><li>By sending us a support ticket</li></ul><h4><strong>How does our site handle do not track signals?</strong></h4><p>We honor do not track signals and do not track, plant cookies, or use advertising when a do not track (dnt) browser mechanism is in place. Does our site allow third party behavioral tracking?</p><p>We do not allow third party behavioral tracking</p><h4><strong>Contacting us</strong></h4><p>If there are any questions regarding this privacy policy you may contact us using the information below.</p><p><a href="\">info@servername.com</a></p>', 'slug' => 'privacy', 'meta_robots' => 'index, follow']
        ]);

        $pages      = $this->page_model->find_all();
        $permsPages = [];

        foreach ($pages as $page) {
            $permsPages[] = [
                'key'         => $page->id,
                'module'      => ':page:',
                'description' => "Can view {$page->title} page"
            ];
        }

        $this->permission_model->insert_batch($permsPages);

        $permissions = $this->permission_model->find_all(['module' => ':page:']);
        $permsLinked = [];

        foreach ($permissions as $permission) {
            $permsLinked[] = ['role_id' => '1', 'permission_id' => $permission->id];
            $permsLinked[] = ['role_id' => '2', 'permission_id' => $permission->id];
            $permsLinked[] = ['role_id' => '3', 'permission_id' => $permission->id];
            $permsLinked[] = ['role_id' => '4', 'permission_id' => $permission->id];
            $permsLinked[] = ['role_id' => '5', 'permission_id' => $permission->id];
        }

        $this->role_permission_model->insert_batch($permsLinked);
    }

    public function down()
    {
        $this->dbforge->drop_table('pages');

        $permissions    = $this->permission_model->find_all(['module' => ':page:'], 'array');
        $permissionsIds = array_column($permissions, 'id');

        if ($permissionsIds !== []) {
            $this->permission_model->delete_in('id', $permissionsIds);
        }
    }
}
