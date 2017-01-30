<?php

$this->startSetup();

$sql = 'CREATE TABLE codilar_heatmap_tracker_data (
	id INT AUTO_INCREMENT PRIMARY KEY,
	created_at DATE NOT NULL,
	uri VARCHAR(255) NOT NULL,
	coordinates VARCHAR( 255 ) NOT NULL,
	screen_size VARCHAR( 255 ) NOT NULL);';

$this->run($sql);

$this->endSetup();