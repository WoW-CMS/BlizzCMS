<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_pages extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'description' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => TRUE
			),
			'created_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('pages');

		$data = array(
			array('title' => 'Terms and Conditions', 'description' => '<p>by accessing or using servername.com (the "Site") and its services (the "Services"), you (the "User") agree to comply with the terms and conditions governing the user\'s use of any areas of the site and affiliated services as set forth below.</p><h4>Use of site</h4><p>this site or any portion of the site as well as the services may not be reproduced, duplicated, copied, sold, resold, or otherwise exploited for any commercial purpose except as expressly permitted by servername.com. servername reserves the right to refuse service in its discretion, without limitation, if servername believes the user conduct violates applicable law or is harmful to the interests of servername, other users of the site and the services or its affiliates.</p><h4>Use of services</h4><p>servername.com is a non-profit project developed to imitate outdated game versions for educational purposes only. the site and the services do not support and do not provide any modification to game files. by using the site or the services, the user agrees to take responsibility to follow game’s eula.</p><h4>Distribution</h4><p>servername.com does not support distribution of any game clients. download links on the site constitute mirrors of external sites for educational purposes.</p><h4>Site account</h4><p>the user may register a regular account and password for the service for free. you are responsible for all activity under your account, associated accounts, and passwords. the site is not responsible for unauthorised access to your account, and any loss of virtual items associated with it.</p><h4>Events, videos and community creations</h4><p>upon registering an account, you agree that your account or characters may be included in any events, streams or videos for promotion or review purposes.</p><h4>Access to the site and services</h4><p>servername provides free and unlimited access to the site and the services.</p><h4>Submission</h4><p>servername does not assume any obligation with respect to any submission and no confidential or fiduciary understanding or relationship is established by the site\'s receipt or acceptance of any submission. all submissions become the exclusive property of the site and its affiliates. the site and its affiliates may use any submission without restriction and the user shall not be entitled to any compensation.</p><h4>Third-party content</h4><p>neither servername, nor its affiliates, nor any of their respective officers, directors, employees, or agents, nor any third party, including any provider/affiliate, or any other user of the site and services, guarantees the accuracy, completeness, or usefulness of any content, nor its merchantability or fitness for any particular purpose. in some instances, the content available through the site may represent the opinions and judgments of providers/affiliates or users. servername and its affiliates do not endorse and shall not be responsible for the accuracy or reliability of any opinion, advice, or statement made on the site and the services by anyone other than authorised servername employees. under no circumstances shall servername, or its affiliates, or any of their respective officers, directors, employees, or agents be liable for any loss, damage or harm caused by a user\'s reliance on information obtained through the site and the services. it is the responsibility of the user to evaluate the information, opinion, advice, or other content available through this site.</p><h4>Disclaimers and limitation of liability</h4><p>user agrees that use of the site and the services is at the user\'s sole risk. neither servername, nor its affiliates, nor any of their respective officers, directors, employees, agents, third-party content providers, merchants, sponsors, licensors or the like (collectively, "providers"), warrant that the site and the services will be uninterrupted or error-free; nor do they make any warranty as to the results that may be obtained from the use of the site and the services, or as to the accuracy, reliability, or currency of any information content, service, or merchandise provided through this site. the site and the services are provided by servername on an "as is" and "as available" basis. the site makes no representations or warranties of any kind, express or implied, as to the operation of the site, the information, content, materials or products, included on this site. to the full extent permissible by applicable law, the site disclaims all warranties, express or implied, including but not limited to, implied warranties of merchantability and fitness for a particular purpose. servername will not be liable for any damages of any kind arising from the use of the site and the services, including but not limited to direct, indirect, incidental, punitive and consequential damages. under no circumstances shall servername or any other party involved in creating, producing, or distributing the site and the services be liable for any direct, indirect, incidental, special, or consequential damages that result from the use of or inability to use the site and the services, including but not limited to reliance by the user on any information obtained from the site or that result from mistakes, omissions, interruptions, deletion of files or email, errors, defects, viruses, delays in operation or transmission, or any failure of performance, whether or not resulting from acts of god, communications failure, theft, destruction, or unauthorised access to the site\'s records, programs, or services. the user hereby acknowledges that these disclaimers and limitation on liability shall apply to all content, merchandise, and services available through the site and the services. in states that do not allow the exclusion of limitation or limitation of liability for consequential or incidental damages, the user agrees that liability in such states shall be limited to the fullest extent permitted by applicable law.</p><h4>Termination of service</h4><p>servername reserves the right, in its sole discretion, to change, suspend, limit, or discontinue any aspect of the service and the services at any time. servername may suspend or terminate any user\'s access to all or part of the site and the services, without notice, for any conduct that servername, in its sole discretion, believes is in violation of these terms and conditions.</p><h4>Acknowledgement</h4><p>by accessing or using the site and the services, the user agrees to be bound by these terms and conditions, including disclaimers. servername reserves the right to make changes to the site and these terms and conditions, including disclaimers, at any time. if you do not agree to the provisions of this agreement or are not satisfied with the service, your sole and exclusive remedy is to discontinue your use of the service.</p><h4>Privacy statement</h4><p>certain user information collected through the use of this website is automatically stored for reference. we track such information to perform internal research on our users demographic interests and behaviour and to better understand, protect and serve our community of users. payment or any other financial information is never submitted, disclosed or stored on the site and is bound to terms and conditions and privacy policy of our respective partners and/or payment processors. basic user information (such as ip address, logs for using website interface and account management) may be disclosed to our partners in mutual efforts to counter potential illegal activities. servername makes significant effort to protect submitted information to prevent unauthorised access to that information in its internal procedures and technology. however, we do not guarantee, nor should you expect, that your personal information and private communications will always remain private.</p>', 'slug' => 'tos', 'created_at' => '2021-05-23 12:00:00')
		);
		$this->db->insert_batch('pages', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('pages');
	}
}
