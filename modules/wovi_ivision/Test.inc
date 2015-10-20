<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'IVisionController.php';





//$iVision = new IVisionController(array(

//));
//
//try{
//  $function_name = 'getChild';
//  $result = $iVision->$function_name(array(
//    'iVisionID' => '30546'
//  ));
//  print_r($result);
// } catch (IVisionException $e) {
//  echo $e->getMessage();
//}
//$importDateBuf = date("Y-m-d")." 00:00:00.000";
//$importTimeBuf = "1754-01-01 ".date("H:i:s").".000";

//try{
//  echo $ivision->setNewComfortIncident(array(
//    'post' => array(
//      'webReferenceID' => 10001,
//      'partnerID' => 0,
//      'importDateBuf' => $importDateBuf,
//      'importTimeBuf' => $importTimeBuf,
//      'firstName' => 'TEST'
//    )
//  ));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}

//try{
//  echo $ivision->setNewIncident(array(
//    'post' => array(
//      'webReferenceID' => 10001,
//    )
//  ));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}

//try{
//  echo $ivision->setMultipleDonation(array(
//    'onlineType' => 0,
//    'post' => array(
//      'webReferenceID' => 10001,
//    )
//  ));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}

//try{
//  echo $ivision->setEnquiry(array(
//    'onlineType' => 0,
//    'post' => array(
//      'webReferenceID' => 10001,
//    )
//  ));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}
//
//try{
//  echo $iVision->setNonComfortIncident(array(
//    'post' => array(
//      'webReferenceID' => 10001,
//      'onlinePartnerID' => 0,
//    )
//  ));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}

//try{
//  print_r( $iVision->setNonComfortMultipleDonation(array(
//    'post' => array(
//      'webReferenceID' => '10001',
//    )
//  )));
//} catch (IVisionException $e) {
//  echo $e->getMessage();
//}










//API('Child Languages', 'getChildLanguages', array(
//));
//API('Child Genders', 'getChildGenders', array());
//API('Child Countries', 'getChildCountries', array(
//
//));
//API('Retrieve Sponsor Children Statistics', 'getProjectSponsorChildrenStatistics', array(
//  'projectID' => '179237'
//));
API('Retrieve Gift Categories', 'getGiftCategories', array(

));
//API('Retrieve Gift', 'getGift', array(
//  'iVisionID' => 2
//));
//API('Retrieve Gifts for a Category', 'getGiftsforCategory', array(
//  'giftCategory' => 'kala'
//));
//API('Retrieve Gifts for a Price Range', 'getGiftsforPriceRange', array(
//  'lowerPrice' => '10',
//  'upperPrice' => '100'
//));
//API('Related Gifts for Category', 'getRelatedGiftsforCategory', array(
//  'giftCategory' => 'kala',
//  'FilterID' => 0,
//  'maxNumberToReturn' => '1'
//));
//API('Retrieve Donation Programs', 'getDonationPrograms', array(
//
//));
//API('Retrieve Partner by Partner ID : All sections of the partner information will be loaded', 'getPartnerById', array(
//  'partnerID' => '000081084'
//));
//API('Retrieve Partner by Partner ID : To load only part of the partner use this', 'getPartnerSpecial', array(
//  'partnerID' => 000222533,
//  'loadHasPendingOrder' => '1',
//  'loadHasPendingContactInfo' => '1',
//  'loadHasPendingPaymentUpdate' => '1',
//  'loadHasPendingLumpSumPayment' => '1',
//  'loadPartnerStatus' => '1',
//  'loadAddressAddition' => '1'
//));
//API('Retrieve Partner by Portal Account ID', 'getPartnerByPortalAccountID', array(
//  'portalAccountGuid' => 'f85aea4f-1add-486f-b4cb-54dff746fab2'
//));

//API('Retrieve Payment History', 'getPaymentHistory', array(
//  'partnerID' => '1',
//  'cutoff' => '20011111'
//));
//API('Retrieve Ongoing Givings', 'getOngoingGivings', array(
//  'partnerID' => '1'
//));
//API('Retrieve Partner Titles', 'getPartnerTitles', array());
//API('Retrieve Partner Countries', 'getPartnerCountries', array());
//API('Retrieve Partner Salutations', 'getPartnerSalutations', array());
//API('Retrieve Partner My Sponsored Children', 'getPartnerMySponsoredChildren', array(
//  'partnerID' => '1',
//));
//API('Retrieve Partner Base Info List', 'getPartnerBaseInfoList', array(
//  'date' => '2012-11-01',
//  'isNew' => '1',
//  'typeID' => '0'
//));
//API('Retrieve Payment Methods', 'getPaymentMethods', array(
//  'partnerID' => '1',
//  'languageID' => '1'
//));
//API('Retrieve Payment Accounts', 'getPaymentAccounts', array(
//  'partnerID' => '1',
//  'languageID' => 'DEU'
//));
//API('Update Donor Info : post method', 'setDonorInfo', array(
//  'post' => array(
//    'webReferenceID' => 10012
//  )
//));
//API('Retrieve Step Wise Child', 'getStepWiseChild', array(
//  'childID' => 'IND-184150-1443'
//));
//API('Retrieve Step Wise Child with filter', 'getStepWiseChildSpecial', array(
//  'childID' => 'IND-184150-1443'
//  'loadFamilyMembers' => '1',
//  'loadChildParticipations' => '1',git info
//  'loadFamilyParticipations' => '1',
//  'loadChildSupports' => '1',
//  'loadFamilySupports' => '1',
//  'loadCorrespondences' => '1',
//  'loadVocationalTrainings' => '1'
//));
//API('Retrieve Gift Cards By GiftCatalogueID', 'getGiftCardsByGiftCatalogueID', array(
//  'giftCatalogueID' => 1,
//  'languageCode' => 'DEU',
//));
//API('Retrieve Gift Cards By GiftCardID', 'getGiftCardsByGiftCardID', array(
//  'languageCode' => 'DEU',
//  'giftCardID' => '1'
//));
//API('Retrieve Gift Card Images By GiftCardID', 'getGiftCardsImagesByGiftCardID', array(
//  'giftCardID' => '1',
//  'height' => 0,
//  'width' => 0,
//));
//API('Retrieving Interaction Information', 'getInteractionInformation', array(
//  'partnerID' => '1',
//  'templateCode' => '1',
//  'subjectCode' => '1',
//  'startingID' => '1',
//  'maxToReturn' => 1,
//  'fromDate' => '1'
//));
//API('Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date', 'getPartnerInformationList', array(
//  'siteID' => '1',
//  'typeID' => '1'
//));
//API('Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date with filter', 'getPartnerInformationListSpecial', array(
//  'siteID' => '1',
//  'typeID' => '1',
//  'loadHasPendingOrder' => '1',
//  'loadHasPendingContactInfo' => '1',
//  'loadHasPendingPaymentUpdate' => '1',
//  'loadHasPendingLumpSumPayment' => '1',
//  'loadPartnerStatus' => '1',
//  'loadAddressAddition' => '1',
//  'Values' => '1'
//));
//API('Retrieve Partner Profile Info by PartnerID', 'getPartnerProfileInformation', array(
//  'siteID' => '1',
//  'partnerID' => '1'
//));

function API($label, $method, $argument) {

  $iVision = new IVisionController(array(
    'uri' => 'https://194.100.93.110/svc_uat/',
    'language' => 'DEU',
    'siteID' => 'FINO'
  ));
  echo $label . "<br/>";
  try {
    $result = $iVision->$method($argument);
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    echo "<hr/>";
  } catch (IVisionException $e) {
    echo $e->getMessage();
  }
}
