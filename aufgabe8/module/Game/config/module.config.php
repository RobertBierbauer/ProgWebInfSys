<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Game\Controller\Game' => 'Game\Controller\GameController',
        ),
    ),
	
	// The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'game' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/game[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Game\Controller\Game',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
    	'strategies' => array(
    		'ViewJsonStrategy',
    	),
        'template_path_stack' => array(
            'game' => __DIR__ . '/../view',
        ),
    ),
);