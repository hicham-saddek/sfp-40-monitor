<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class VariableSeeder extends Seeder
{
    protected array $channels = [ 1 => [ [ 'title' => 'ACQUITDEFAUTS', 'description' => 'Bp acquitement defaut', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1046 ], [ 'title' => 'BOUTONPOUSSOIR5', 'description' => 'bouton pousoir education 5', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1042 ], [ 'title' => 'BOUTONPOUSSOIR6', 'description' => 'bouton pousoir education 6', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1043 ], [ 'title' => 'CPVENT', 'description' => 'capteur pression ventouse', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1014 ], [ 'title' => 'ENCOCH', 'description' => 'Cateur controle encoche', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1037 ], [ 'title' => 'FCA0R', 'description' => 'fin de course verin alimentation 0 rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1015 ], [ 'title' => 'FCA0S', 'description' => 'fin de course verin alimentation 0 sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1016 ], [ 'title' => 'FCA1R', 'description' => 'fin de course verin alimentation 1 rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1017 ], [ 'title' => 'FCA1S', 'description' => 'fin de course verin alimentation 1 sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1018 ], [ 'title' => 'FCA2R', 'description' => 'fin de course verin alimentation 2 rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1019 ], [ 'title' => 'FCA2S', 'description' => 'fin de course verin alimentation 2 sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1020 ], [ 'title' => 'FCA3R', 'description' => 'fin de course verin alimentation 3 rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1021 ], [ 'title' => 'FCA3S', 'description' => 'fin de course verin alimentation 3 sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1022 ], [ 'title' => 'FCGXR', 'description' => 'fin de course grand verin rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1008 ], [ 'title' => 'FCGXS', 'description' => 'fin de course grand verin sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1009 ], [ 'title' => 'FCIDXB', 'description' => 'fin de course soulevement palette bas ', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1024 ], [ 'title' => 'FCIDXH', 'description' => 'fin de course soulevement palette haut', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1023 ], [ 'title' => 'FCPXR', 'description' => 'fin de course petit verin rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1010 ], [ 'title' => 'FCPXS', 'description' => 'fin de course petit verin sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1011 ], [ 'title' => 'FCSTDR', 'description' => 'fin de course stop palette convoyeur aiguillage rentre ', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1028 ], [ 'title' => 'FCSTDS', 'description' => 'fin de course stop palette convoyeur aiguillage sortie ', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1027 ], [ 'title' => 'FCSTPR', 'description' => 'fin de course stop palette poste rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1026 ], [ 'title' => 'FCSTPS', 'description' => 'fin de course stop palette poste sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1025 ], [ 'title' => 'FCVRD', 'description' => 'fin de course verin rotatif droite', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1012 ], [ 'title' => 'FCVRG', 'description' => 'fin de course verin rotatif gauche', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1013 ], [ 'title' => 'FCVZB', 'description' => 'fin de course verin z sortie bas', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1029 ], [ 'title' => 'FCVZH', 'description' => 'fin de course verin z rentre haut', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1030 ], [ 'title' => 'MODEARRET', 'description' => 'mode manu 0	', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1049 ], [ 'title' => 'MODEAUTO', 'description' => 'mode auto 3', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1047 ], [ 'title' => 'MODEINIT', 'description' => 'ModeManu 2', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1050 ], [ 'title' => 'MODEMANU', 'description' => 'mode manu	1', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1048 ], [ 'title' => 'PPA1P', 'description' => 'presence piece poste', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1032 ], [ 'title' => 'PPC0', 'description' => 'presence piece alimentation 0', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1033 ], [ 'title' => 'PPC1', 'description' => 'presence piece alimentation 1', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1034 ], [ 'title' => 'PPC2', 'description' => 'presence piece alimentation 2', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1035 ], [ 'title' => 'PPC3', 'description' => 'presence piece alimentation 3', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1036 ], [ 'title' => 'PPEP', 'description' => 'presence piece entree poste', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1031 ], [ 'title' => 'SELECTEUR1', 'description' => 'selecteur education 1', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1038 ], [ 'title' => 'SELECTEUR2', 'description' => 'selecteur education 2', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1039 ], [ 'title' => 'SELECTEUR3', 'description' => 'selecteur education 3', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1040 ], [ 'title' => 'SELECTEUR4', 'description' => 'bouton pousoir education 4', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1041 ], [ 'title' => 'START', 'description' => 'bouton pousoir start', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1044 ], [ 'title' => 'STOP', 'description' => 'bouton pousoir stop', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1045 ], [ 'title' => 'EVA0', 'description' => 'Ev alimenation 0', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1061 ], [ 'title' => 'EVA1', 'description' => 'Ev alimenation 1', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1062 ], [ 'title' => 'EVA2', 'description' => 'Ev alimenation 2', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1063 ], [ 'title' => 'EVA3', 'description' => 'Ev alimenation 3', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1064 ], [ 'title' => 'EVGXR', 'description' => 'Ev rentrer grand verin rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1054 ], [ 'title' => 'EVGXS', 'description' => 'EV sortir grand verin sortie	', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1052 ], [ 'title' => 'EVIDX', 'description' => 'Ev soulevement palette au poste', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1065 ], [ 'title' => 'EVPXR', 'description' => 'Ev rentrer petit verin rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1056 ], [ 'title' => 'EVPXS', 'description' => 'Ev sortir petit verin  sortie ', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1055 ], [ 'title' => 'EVSA', 'description' => 'Ev stop palette convoyeur entree aiguillage	', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1085 ], [ 'title' => 'EVSAG', 'description' => 'Ev aiguillage convoyeur', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1084 ], [ 'title' => 'EVSTD', 'description' => 'Ev stop palette convoyeur sortie aiguillage', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1086 ], [ 'title' => 'EVSTP', 'description' => 'Ev stop palette au poste', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1066 ], [ 'title' => 'EVVRD', 'description' => 'Ev rotation droite', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1057 ], [ 'title' => 'EVVRG', 'description' => 'Ev rotation gauche', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1058 ], [ 'title' => 'EVVTA', 'description' => 'Ev ventouse marche', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1052 ], [ 'title' => 'EVVTM', 'description' => 'Ev ventouse marche', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1059 ], [ 'title' => 'EVVZ', 'description' => 'Ev sortir verin Z ', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1067 ], [ 'title' => 'FCSAGR', 'description' => 'fin de course aiguillage convoyeur entre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1081 ], [ 'title' => 'FCSAGS', 'description' => 'fin de course aiguillage convoyeur sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1080 ], [ 'title' => 'FCSAS', 'description' => 'fin de course stop palette convoyeur entree aiguillage sortie', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1082 ], [ 'title' => 'FCSAR', 'description' => 'fin de course stop palette convoyeur entree aiguillage rentre', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1083 ], [ 'title' => 'LACQDEFAUT', 'description' => 'voyant acquitement defaut  ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1074 ], [ 'title' => 'LREARM', 'description' => 'Voyant Rearm ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1076 ], [ 'title' => 'LSTART', 'description' => 'voyant start ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1075 ], [ 'title' => 'PPEE', 'description' => 'presence piece entree convoyeur', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1077 ], [ 'title' => 'PPMCA', 'description' => 'presence piece milieu convoyeur aiguillage', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1078 ], [ 'title' => 'PPSCA', 'description' => 'presence piece sortie convoyeur aiguillage', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1079 ], [ 'title' => 'VOYANT1', 'description' => 'voyant education 1   ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1068 ], [ 'title' => 'VOYANT2', 'description' => 'voyant education 2   ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1069 ], [ 'title' => 'VOYANT3', 'description' => 'voyant education 3   ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1070 ], [ 'title' => 'VOYANT4', 'description' => 'voyant education 4   ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1071 ], [ 'title' => 'VOYANT5', 'description' => 'voyant education 5   ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1072 ], [ 'title' => 'VOYANT6', 'description' => 'voyant education 6    ok', 'opc_ua_namespace_index' => 3, 'opc_ua_identifier' => 1073 ],
    ],
    ];

    public function run()
    {
        foreach ($this->channels as $channel => $variables) {
            Channel::find($channel)->variables()->createMany($variables);
        }
    }
}