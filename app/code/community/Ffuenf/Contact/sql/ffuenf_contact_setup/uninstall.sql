-- add table prefix if you have one
DELETE FROM core_config_data WHERE path like 'ffuenf_contact/%';
DELETE FROM core_config_data WHERE path = 'advanced/modules_disable_output/Ffuenf_Contact';
DELETE FROM core_resource WHERE code = 'ffuenf_contact_setup';