<?php

/**
 * Job board is represented as an assosiative array with each company having an array of requirements.
 * Applicants must have atleast one of the requirements in all the sub arrays in the requirements array
 * to be eligible for the job.
 * 
 * @var array jobsBoardAndRequirements
 */
$jobsBoardAndRequirements = [
    'Company A' => [['apartment','house'], ['property insurance']],
    'Company B' => [['5 door car','4 door car'], ['driver\'s'],['car insurance']],
    'Company C' => [['social security number'], ['work permit']],
    'Company D' => [['apartment', 'flat', 'house']],
    'Company E' => [['driver\'s license'], ['2 door car', '3 door car', '4 door car', '5 door car']],
    'Company F' => [['scooter','bike', 'motorcycle'], ['driver\'s license'],['motorcycle insurance']],
    'Company G' => [['massage qualification certificate'],['liability insurance']],
    'Company H' => [['storage place','garage']],
    'Company J' => [[]],
    'Company K' => [['PayPal account']]
];

/**
 * requirements the applicant has
 * 
 * @var array $requirementsApplicantHas
 */
$requirementsApplicantHas = [
    'bike', 'driver\'s license'
];

/**
 * 
 * @param array $jobsBoard
 * @param array $myRequirements
 * 
 * @return array
 */
function companiesApplicantCanWorkAt($jobsBoard, $myRequirements)
{
    $companiesApplicantCanApplyTo = [];
    $allCompanies = array_keys($jobsBoard);
    
    foreach($jobsBoard as $company => $requirements) {
        //company has zero requirements
        if (empty($requirements[0])) {
            array_push($companiesApplicantCanApplyTo, $company);
        }

        $numberOfRequirementsApplicantMeets = 0;
        $numberOfCompulsoryRequirements     = count($requirements);

        foreach($requirements as $requirement) {
            $requirementsMet = array_intersect($requirement, $myRequirements);

            if(empty($requirementsMet)) {
                //applicant doesn't have a required requirement and we don't have to check the other requirements
                continue;
            } else {
                $numberOfRequirementsApplicantMeets += 1;
            }

            //check if this applicant meets all the required qualifications
            if ($numberOfCompulsoryRequirements == $numberOfRequirementsApplicantMeets) {
                array_push($companiesApplicantCanApplyTo, $company);
            }
        }
    }

    $companiesApplicantCannotApplyTo = array_diff($allCompanies, $companiesApplicantCanApplyTo);

    return [
        'companies I can work for' => $companiesApplicantCanApplyTo,
        'companies I can\'t work for' => $companiesApplicantCannotApplyTo
    ];
}
