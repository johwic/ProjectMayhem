<?php

namespace AppBundle\Utils;

abstract class EventFilter {

    private static $eventTypes = array('shotSixYardBox' => 0, 'shotPenaltyArea' => 1, 'shotOboxTotal' => 2, 'shotOpenPlay' => 3, 'shotCounter' => 4, 'shotSetPiece' => 5, 'shotOffTarget' => 6, 'shotOnPost' => 7, 'shotOnTarget' => 8, 'shotsTotal' => 9, 'shotBlocked' => 10, 'shotRightFoot' => 11, 'shotLeftFoot' => 12, 'shotHead' => 13, 'shotObp' => 14, 'goalSixYardBox' => 15, 'goalPenaltyArea' => 16, 'goalObox' => 17, 'goalOpenPlay' => 18, 'goalCounter' => 19, 'goalSetPiece' => 20, 'penaltyScored' => 21, 'goalOwn' => 22, 'goalNormal' => 23, 'goalRightFoot' => 24, 'goalLeftFoot' => 25, 'goalHead' => 26, 'goalObp' => 27, 'shortPassInaccurate' => 28, 'shortPassAccurate' => 29, 'passCorner' => 30, 'passCornerAccurate' => 31, 'passCornerInaccurate' => 32, 'passFreekick' => 33, 'passBack' => 34, 'passForward' => 35, 'passLeft' => 36, 'passRight' => 37, 'keyPassLong' => 38, 'keyPassShort' => 39, 'keyPassCross' => 40, 'keyPassCorner' => 41, 'keyPassThroughball' => 42, 'keyPassFreekick' => 43, 'keyPassThrowin' => 44, 'keyPassOther' => 45, 'assistCross' => 46, 'assistCorner' => 47, 'assistThroughball' => 48, 'assistFreekick' => 49, 'assistThrowin' => 50, 'assistOther' => 51, 'dribbleLost' => 52, 'dribbleWon' => 53, 'challengeLost' => 54, 'interceptionWon' => 55, 'clearanceHead' => 56, 'outfielderBlock' => 57, 'passCrossBlockedDefensive' => 58, 'outfielderBlockedPass' => 59, 'offsideGiven' => 60, 'offsideProvoked' => 61, 'foulGiven' => 62, 'foulCommitted' => 63, 'yellowCard' => 64, 'voidYellowCard' => 65, 'secondYellow' => 66, 'redCard' => 67, 'turnover' => 68, 'dispossessed' => 69, 'saveLowLeft' => 70, 'saveHighLeft' => 71, 'saveLowCentre' => 72, 'saveHighCentre' => 73, 'saveLowRight' => 74, 'saveHighRight' => 75, 'saveHands' => 76, 'saveFeet' => 77, 'saveObp' => 78, 'saveSixYardBox' => 79, 'savePenaltyArea' => 80, 'saveObox' => 81, 'keeperDivingSave' => 82, 'standingSave' => 83, 'closeMissHigh' => 84, 'closeMissHighLeft' => 85, 'closeMissHighRight' => 86, 'closeMissLeft' => 87, 'closeMissRight' => 88, 'shotOffTargetInsideBox' => 89, 'touches' => 90, 'assist' => 91, 'ballRecovery' => 92, 'clearanceEffective' => 93, 'clearanceTotal' => 94, 'clearanceOffTheLine' => 95, 'dribbleLastman' => 96, 'errorLeadsToGoal' => 97, 'errorLeadsToShot' => 98, 'intentionalAssist' => 99, 'interceptionAll' => 100, 'interceptionIntheBox' => 101, 'keeperClaimHighLost' => 102, 'keeperClaimHighWon' => 103, 'keeperClaimLost' => 104, 'keeperClaimWon' => 105, 'keeperOneToOneWon' => 106, 'parriedDanger' => 107, 'parriedSafe' => 108, 'collected' => 109, 'keeperPenaltySaved' => 110, 'keeperSaveInTheBox' => 111, 'keeperSaveTotal' => 112, 'keeperSmother' => 113, 'keeperSweeperLost' => 114, 'keeperMissed' => 115, 'passAccurate' => 116, 'passBackZoneInaccurate' => 117, 'passForwardZoneAccurate' => 118, 'passInaccurate' => 119, 'passAccuracy' => 120, 'cornerAwarded' => 121, 'passKey' => 122, 'passChipped' => 123, 'passCrossAccurate' => 124, 'passCrossInaccurate' => 125, 'passLongBallAccurate' => 126, 'passLongBallInaccurate' => 127, 'passThroughBallAccurate' => 128, 'passThroughBallInaccurate' => 129, 'passThroughBallInacurate' => 130, 'passFreekickAccurate' => 131, 'passFreekickInaccurate' => 132, 'penaltyConceded' => 133, 'penaltyMissed' => 134, 'penaltyWon' => 135, 'passRightFoot' => 136, 'passLeftFoot' => 137, 'passHead' => 138, 'sixYardBlock' => 139, 'tackleLastMan' => 140, 'tackleLost' => 141, 'tackleWon' => 142, 'cleanSheetGK' => 143, 'cleanSheetDL' => 144, 'cleanSheetDC' => 145, 'cleanSheetDR' => 146, 'cleanSheetDML' => 147, 'cleanSheetDMC' => 148, 'cleanSheetDMR' => 149, 'cleanSheetML' => 150, 'cleanSheetMC' => 151, 'cleanSheetMR' => 152, 'cleanSheetAML' => 153, 'cleanSheetAMC' => 154, 'cleanSheetAMR' => 155, 'cleanSheetFWL' => 156, 'cleanSheetFW' => 157, 'cleanSheetFWR' => 158, 'cleanSheetSub' => 159, 'goalConcededByTeamGK' => 160, 'goalConcededByTeamDL' => 161, 'goalConcededByTeamDC' => 162, 'goalConcededByTeamDR' => 163, 'goalConcededByTeamDML' => 164, 'goalConcededByTeamDMC' => 165, 'goalConcededByTeamDMR' => 166, 'goalConcededByTeamML' => 167, 'goalConcededByTeamMC' => 168, 'goalConcededByTeamMR' => 169, 'goalConcededByTeamAML' => 170, 'goalConcededByTeamAMC' => 171, 'goalConcededByTeamAMR' => 172, 'goalConcededByTeamFWL' => 173, 'goalConcededByTeamFW' => 174, 'goalConcededByTeamFWR' => 175, 'goalConcededByTeamSub' => 176, 'goalConcededOutsideBoxGoalkeeper' => 177, 'goalScoredByTeamGK' => 178, 'goalScoredByTeamDL' => 179, 'goalScoredByTeamDC' => 180, 'goalScoredByTeamDR' => 181, 'goalScoredByTeamDML' => 182, 'goalScoredByTeamDMC' => 183, 'goalScoredByTeamDMR' => 184, 'goalScoredByTeamML' => 185, 'goalScoredByTeamMC' => 186, 'goalScoredByTeamMR' => 187, 'goalScoredByTeamAML' => 188, 'goalScoredByTeamAMC' => 189, 'goalScoredByTeamAMR' => 190, 'goalScoredByTeamFWL' => 191, 'goalScoredByTeamFW' => 192, 'goalScoredByTeamFWR' => 193, 'goalScoredByTeamSub' => 194, 'aerialSuccess' => 195, 'duelAerialWon' => 196, 'duelAerialLost' => 197, 'offensiveDuel' => 198, 'defensiveDuel' => 199, 'bigChanceMissed' => 200, 'bigChanceScored' => 201, 'bigChanceCreated' => 202, 'overrun' => 203, 'successfulFinalThirdPasses' => 204, 'punches' => 205, 'penaltyShootoutScored' => 206, 'penaltyShootoutMissedOffTarget' => 207, 'penaltyShootoutSaved' => 208, 'penaltyShootoutSavedGK' => 209, 'penaltyShootoutConcededGK' => 210, 'throwIn' => 211, 'subOn' => 212, 'subOff' => 213, 'defensiveThird' => 214, 'midThird' => 215, 'finalThird' => 216, 'pos' => 217);

    public static function isSuccessful($event, $bool){
        return isset($event->outcomeType) && $event->outcomeType->value == $bool;
    }

    public static function isAnyOfTypes($event, $typeIds) {
        $satisfied = false;
        foreach ($typeIds as $typeId) {
            $satisfied = ($satisfied or EventFilter::isOfType($event, $typeId));
        }

        return $satisfied;
    }

    public static function isOfType($event, $typeId) {
        if (!isset($event->type)) return false;

        return $event->type->value == $typeId;
    }

    public static function hasAnySatisfier($event, $satisfierNames) {
        $satisfied = false;
        foreach ($satisfierNames as $satisfierName) {
            $satisfied = ($satisfied or EventFilter::hasSatisfier($event, $satisfierName));
        }

        return $satisfied;
    }

    public static function hasSatisfier($event, $satisfierName) {
        if (!isset($event->satisfiedEventsTypes)) return false;

        return in_array(EventFilter::$eventTypes[$satisfierName], $event->satisfiedEventsTypes);
    }

    public static function hasNotSatisfier($event, $satisfierName) {
        return !EventFilter::hasSatisfier($event, $satisfierName);
    }

    public static function isTouch($event, $bool) {
        return ($event->isTouch == $bool);
    }
}