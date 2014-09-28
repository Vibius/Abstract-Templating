<?php return [
    
    "vibius" => true,

    "components" => [
        "AbstractTemplating" => [
            "alias" => "view",
            "provider" => "\Vibius\AbstractTemplating\Abstractor( new Vibius\AbstractTemplating\Engines\Twig() , '/app/views/')"
        ]
    ]

];