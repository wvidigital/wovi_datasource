<?php

/**
 * Created by PhpStorm.
 * User: Moritz Vögler /// ARTUS
 * Date: 15.05.15
 * Time: 12:20
 */

/**
 * Class IVisionException
 *  Is be used in the IVisionController.
 * @package IVisionController
 */
class IVisionException extends \Exception {

}

/**
 * Class IVisionController
 *  Handles all IVision Webservice Calls
 *
 * @method mixed getImage() getImage($args = array())
 *  Get One Image.
 * @method mixed getImagesSince() getImagesSince($args = array())
 *  Get Images Updated Since ( date = yyyymmdd ).
 * @method mixed getChildren() getChildren($args = array())
 *  Retrieve Children.
 * @method mixed getChildrenByCountryCode() getChildrenByCountryCode($args = array())
 *  Retrieve Children by Country Code.
 * @method mixed getChildrenByReservationID() getChildrenByReservationID($args = array())
 *  Retrieve Children by reservationID.
 * @method mixed getChild() getChild($args = array())
 *  Retrieve One Child.
 * @method mixed getChildFromTable() getChildFromTable($args = array())
 *  Retrieve One Child from Children Table.
 * @method mixed setNewComfortIncident() setNewComfortIncident($args = array())
 *  Submitting a Donation - Comfort Solution iVision - Submitting an Incident.
 * @method mixed setMultipleDonation() setMultipleDonation($args = array())
 *  Non-Comfort Solution iVision - Submitting Multiple Donations.
 * @method mixed setNewIncident() setNewIncident($args = array())
 *  Submitting Incident.
 * @method mixed getChildMediaURL() getChildMediaURL($args = array())
 *  Media Services - Child Media URL.
 * @method mixed getProjectMediaURL() getProjectMediaURL($args = array())
 *  Project Media URL.
 * @method mixed getChildMultiMedia() getChildMultiMedia($args = array())
 *  Child Multi Media URL.
 * @method mixed getProjectMediaCaption() getProjectMediaCaption($args = array())
 *  Project Media URL With Caption.
 * @method mixed getProjectMedia() getProjectMedia($args = array())
 *  Project Media List.
 * @method mixed getAllProjectMedia() getAllProjectMedia($args = array())
 *  All Project Media List without contentType.
 * @method mixed setEnquiry() setEnquiry($args = array()) Get One Image.
 *  Submitting an Enquiry.
 * @method mixed getChildLanguages() getChildLanguages($args = array())
 * Child Languages
 * @method mixed getChildGenders() getChildGenders($args = array())
 * Child Genders
 * @method mixed getChildCountries() getChildCountries($args = array())
 * Child Countries
 * @method mixed getProjectSponsorChildrenStatistics() getProjectSponsorChildrenStatistics($args = array())
 * Retrieve Sponsor Children Statistics
 * @method mixed getGiftCategories() getGiftCategories($args = array())
 * Retrieve Gift Categories
 * @method mixed getGift() getGift($args = array())
 * Retrieve Gift
 * @method mixed getGiftsforCategory() getGiftsforCategory($args = array())
 * Retrieve Gifts for a Category
 * @method mixed getGiftsforPriceRange() getGiftsforPriceRange($args = array())
 * Retrieve Gifts for a Price Range
 * @method mixed getRelatedGiftsforCategory() getRelatedGiftsforCategory($args = array())
 * Related Gifts for Category
 * @method mixed getDonationPrograms() getDonationPrograms($args = array())
 * Retrieve Donation Programs
 * @method mixed getPartnerById() getPartnerById($args = array())
 * Retrieve Partner by Partner ID : All sections of the partner information will be loaded
 * @method mixed getPartnerSpecial() getPartnerSpecial($args = array())
 * Retrieve Partner by Partner ID : To load only part of the partner use this
 * @method mixed getPartnerByPortalAccountID() getPartnerByPortalAccountID($args = array())
 * Retrieve Partner by Portal Account ID
 * @method mixed getPaymentHistory() getPaymentHistory($args = array())
 * Retrieve Payment History
 * @method mixed getOngoingGivings() getOngoingGivings($args = array())
 * Retrieve Ongoing Givings
 * @method mixed getPartnerTitles() getPartnerTitles($args = array())
 * Retrieve Partner Titles
 * @method mixed getPartnerCountries() getPartnerCountries($args = array())
 * Retrieve Partner Countries
 * @method mixed getPartnerSalutations() getPartnerSalutations($args = array())
 * Retrieve Partner Salutations
 * @method mixed getPartnerMySponsoredChildren() getPartnerMySponsoredChildren($args = array())
 * Retrieve Partner My Sponsored Children
 * @method mixed getPartnerBaseInfoList() getPartnerBaseInfoList($args = array())
 * Retrieve Partner Base Info List
 * @method mixed getPaymentMethods() getPaymentMethods($args = array())
 * Retrieve Payment Methods
 * @method mixed getPaymentAccounts() getPaymentAccounts($args = array())
 * Retrieve Payment Accounts
 * @method mixed getStepWiseChild() getStepWiseChild($args = array())
 * Retrieve Step Wise Child
 * @method mixed getStepWiseChildSpecial() getStepWiseChildSpecial($args = array())
 * Retrieve Step Wise Child with filter
 * @method mixed getGiftCardsByGiftCatalogueID() getGiftCardsByGiftCatalogueID($args = array())
 * Retrieve Gift Cards By GiftCatalogueID
 * @method mixed getGiftCardsByGiftCardID() getGiftCardsByGiftCardID($args = array())
 * Retrieve Gift Cards By GiftCardID
 * @method mixed getGiftCardsImagesByGiftCardID() getGiftCardsImagesByGiftCardID($args = array())
 * Retrieve Gift Card Images By GiftCardID
 * @method mixed getInteractionInformation() getInteractionInformation($args = array())
 * Retrieving Interaction Information
 * @method mixed getPartnerInformationList() getPartnerInformationList($args = array())
 * Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date
 * @method mixed getPartnerInformationListSpecial() getPartnerInformationListSpecial($args = array())
 * Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date with filter
 * @method mixed getPartnerProfileInformation() getPartnerProfileInformation($args = array())
 * Retrieve Partner Profile Info by PartnerID
 * @method mixed setDonorInfo() setDonorInfo($args = array())
 * Update Donor Info : post method
 *
 * @package IVisionController
 */
class IVisionController {

  /**
   * @var array
   *  Saves the last HEAD Connection Info from the IVision Webservice.
   */
  private $log = array();

  /**
   * @var
   *  Saves the generated API URI.
   */
  private $api_call_uri;

  /**
   * @var bool
   *  Saves if the requested data should be dummy data.
   */
  private $dummy_data;

  /**
   * @var array
   *  Saves the generated post data for the POST Requests
   */
  private $api_call_post = array();

  /**
   * @var array
   *  Includes all necessary Connection Data to Set up a Connection to the World Vision Webservice.
   */
  private $api_data = array();

  /**
   * @var array
   *  Includes a Array Mask with all parameters to set up the API Calls.
   *  All Requests will be check against this Array.
   *  First Dimension
   *      The name of the Api Call.
   *  Second Dimension
   *      path : array of all static API path parameters.
   *      args : array of all dynamic API parameters. The following values are possible.
   *              TRUE    = have to be set
   *              FALSE   = optional
   *              array   = list of static path parameters. Have to be set on of them.
   *              post    = list of post parameters. The parameter have the same rules like normal args elements.
   *      method: GET or POST Request.
   */
  private $api_calls = array(
    // Get One Image.
    'getImage' => array(
      'path' => array('images'),
      'args' => array(
        'type' => array('Child', 'Gift', 'Donation', 'PictureFolder'),
        'iVisionID' => TRUE,
        'width' => TRUE,
        'height' => TRUE,
      ),
      'method' => 'GET'
    ),
    // Get Images Updated Since ( date = yyyymmdd ).
    'getImagesSince' => array(
      'path' => array('Images'),
      'args' => array(
        'type' => array('Child', 'Gift', 'Donation'),
        'maxReturn' => TRUE,
        'startingID' => TRUE,
        'width' => FALSE,
        'height' => FALSE,
        'date' => TRUE
      ),
      'method' => 'GET'
    ),
    // Retrieve Children.
    'getChildren' => array(
      'path' => array('sponsorChild'),
      'languageCode' => TRUE,
      'args' => array(
        'maxReturn' => TRUE,
        'startingID' => TRUE,
      ),
      'method' => 'GET',
    ),
    // Retrieve Children by Country Code.
    'getChildrenByCountryCode' => array(
      'path' => array('sponsorChild'),
      'languageCode' => TRUE,
      'args' => array(
        'countryCode' => TRUE,
        'lowerAge' => FALSE,
        'upperAge' => FALSE,
        'maxReturn' => TRUE,
        'startingID' => TRUE,
      ),
      'method' => 'GET'
    ),
    // Retrieve Children by reservationID.
    'getChildrenByReservationID' => array(
      'path' => array('sponsorChild'),
      'languageCode' => TRUE,
      'args' => array(
        'reservationID' => TRUE,
        'maxReturn' => TRUE,
        'startingID' => TRUE
      ),
      'method' => 'GET'
    ),
    // Retrieve One Child.
    'getChild' => array(
      'path' => array('sponsorChild', 'Child'),
      'languageCode' => TRUE,
      'args' => array(
        'iVisionID' => TRUE
      ),
      'method' => 'GET'
    ),
    // Retrieve One Child from Children Table.
    'getChildFromTable' => array(
      'path' => array('sponsorChild', 'Children'),
      'languageCode' => TRUE,
      'args' => array(
        'iVisionID' => TRUE
      ),
      'method' => 'GET'
    ),
    // Submitting a Donation.
    // Comfort Solution�? iVision.
    // Submitting an Incident.
    'setNewComfortIncident' => array(
      'path' => array('Incident', 'NewComfortIncident'),
      'args' => array(
        'post' => array(
          'webReferenceID' => TRUE,
          'partnerID' => FALSE,
          'firstName' => FALSE,
          'middleName' => FALSE,
          'surname' => FALSE,
          'dialectName' => FALSE,
          'jobTitleCode' => FALSE,
          'companyName1' => FALSE,
          'companyName2' => FALSE,
          'addressAdditionType' => FALSE,
          'addrAddFirstName' => FALSE,
          'addrAddSurname' => FALSE,
          'addrAddJobTitleCode' => FALSE,
          'street' => FALSE,
          'houseNo' => FALSE,
          'address2' => FALSE,
          'department' => FALSE,
          'postCode' => FALSE,
          'city' => FALSE,
          'countryCode' => FALSE,
          'pOBox' => FALSE,
          'pOBoxPostCode' => FALSE,
          'territoryCode' => FALSE,
          'pOBoxCountryCode' => FALSE,
          'email' => FALSE,
          'phonePrivate' => FALSE,
          'mobilePhoneNo' => FALSE,
          'faxNo' => FALSE,
          'languageCode' => FALSE,
          'childCountryCode' => FALSE,
          'childGender' => FALSE,
          'regionCodePartner' => FALSE,
          'motivationCode' => FALSE,
          'paymentMethod' => FALSE,
          'bankBranchNo' => FALSE,
          'bankAccountNo' => FALSE,
          'swiftCode' => FALSE,
          'IBAN' => FALSE,
          'creditCardHolder' => FALSE,
          'creditCardExpiryMonth' => FALSE,
          'creditCardExpiryYear' => FALSE,
          'salutation' => FALSE,
          'phoneBusiness' => FALSE,
          'bankAccountHolder' => FALSE,
          'externalReferenceNumber' => FALSE,
          'productCode' => FALSE,
          'incidentType' => FALSE,
          'regionCodeChild' => FALSE,
          'childAge' => FALSE,
          'amountPerPeriod' => FALSE,
          'billingPeriod' => FALSE,
          'nextSubscriptionDate' => FALSE,
          'creditCardSecurityNo' => FALSE,
          'pledgeType' => FALSE,
          'importDateBuf' => FALSE,
          'importTimeBuf' => FALSE,
          'creditCardNo' => FALSE,
          'addrAddSalutionCode' => FALSE,
          'pOBoxCity' => FALSE,
          'partnerBankAccount' => FALSE,
          'projectID' => FALSE,
          'childSequenceNo' => FALSE,
          'gift' => FALSE,
          'externalAddressNo' => FALSE,
          'addressType' => FALSE,
          'creditCardType' => FALSE,
          'pledgeID' => FALSE,
          'catalogueID' => FALSE,
          'catalogueQuantity' => FALSE,
          'designationID' => FALSE,
          'paymentID' => FALSE,
          'birthdate' => FALSE,
          'priority' => FALSE,
          'continent' => FALSE,
          'bankName' => FALSE,
          'note' => FALSE,
          'month13' => FALSE,
          'extraData' => array()
        )
      ),
      'method' => 'POST'
    ),
    // Non-“Comfort Solution�? iVision.
    // Submitting Multiple Donations.
    'setMultipleDonation' => array(
      'path' => array('donation', 'giveDonation'),
      'args' => array(
        'onlineType' => array(0, 1),
        //@todo No Error Handling if user miss this parameter.
        'post' => array(
          'webReferenceID' => FALSE,
          'donorInfo' => array(
            'onlineType' => FALSE,
            'webReferenceID' => FALSE,
            'partnerID' => FALSE,
            'portalAccountID' => FALSE,
            'firstName' => FALSE,
            'middleName' => FALSE,
            'surname' => FALSE,
            'salutationCode' => FALSE,
            'jobTitleCode' => FALSE,
            'compName' => FALSE,
            'compName2' => FALSE,
            'street' => FALSE,
            'houseNo' => FALSE,
            'address2' => FALSE,
            'address3' => FALSE,
            'department' => FALSE,
            'postCode' => FALSE,
            'city' => FALSE,
            'countryCode' => FALSE,
            'POBox' => FALSE,
            'POBoxPostCode' => FALSE,
            'region' => FALSE,
            'regionID' => FALSE,
            'territoryCode' => FALSE,
            'POBoxCountryCode' => FALSE,
            'preferredPhoneNo' => FALSE,
            'phonePrivate' => FALSE,
            'phoneBusiness' => FALSE,
            'mobilePhoneNo' => FALSE,
            'faxNo' => FALSE,
            'preferredEmail' => FALSE,
            'emailPrivate' => FALSE,
            'emailBusiness' => FALSE,
            'languageCode' => FALSE,
            'prevDonated' => FALSE,
            'motivationText' => FALSE,
            'partnerSSN' => FALSE,
            'externalReferenceNumber' => FALSE,
            'comments' => FALSE,
            'additionalMembers' => FALSE,
            'commPreferences' => FALSE,
            'payments' => FALSE,
            'lumpSums' => FALSE,
            'partnerProfiles' => array(
              'questionCode' => FALSE,
              'lineNo' => FALSE
            )
          ),
          'paymentInfo' => array(
            'collectionDate' => FALSE,
            'paidOnline' => FALSE,
            'externalReferenceNumber' => FALSE,
            'paymentMethod' => FALSE,
            'frequency' => FALSE,
            'bankName' => FALSE,
            'custBankAccSSN' => FALSE,
            'bankAccountHolder' => FALSE,
            'bankBranchNo' => FALSE,
            'bankCode' => FALSE,
            'bankAccNo' => FALSE,
            'ABI' => FALSE,
            'BBAN' => FALSE,
            'CAB' => FALSE,
            'transitNo' => FALSE,
            'bankIDNo' => FALSE,
            'oeNBRegistrationNo' => FALSE,
            'SWIFT' => FALSE,
            'IBAN' => FALSE,
            'creditCardType' => FALSE,
            'creditCardNo' => FALSE,
            'crCardSecNo' => FALSE,
            'crCardHolder' => FALSE,
            'crCardExMonth' => FALSE,
            'crCardExYear' => FALSE,
            'pledgeID' => FALSE,
            'amount' => FALSE
          ),
          'sponsorships' => array(
            'key' => FALSE,
            'transactionID' => FALSE,
            'incidentType' => FALSE,
            'iVisionID' => FALSE,
            'childCountryCode' => FALSE,
            'childGender' => FALSE,
            'childAge' => FALSE,
            'motivationCode' => FALSE,
            'motivationText' => FALSE,
            'amount' => FALSE,
            'comments' => FALSE,
            'childSequence' => FALSE,
            'childName' => FALSE,
            'donationCountryCode' => FALSE,
            'donationProjectDesc' => FALSE,
            'childProjectID' => FALSE
          ),
          'donations' => array(
            'key' => FALSE,
            'transactionID' => FALSE,
            'incidentType' => FALSE,
            'iVisionID' => FALSE,
            'motivationCode' => FALSE,
            'motivationText' => FALSE,
            'quantitySold' => FALSE,
            'amount' => FALSE,
            'comments' => FALSE,
            'anonymous' => FALSE
          ),
          'gifts' => array(
            'key' => FALSE,
            'transactionID' => FALSE,
            'incidentType' => FALSE,
            'iVisionID' => FALSE,
            'motivationCode' => FALSE,
            'motivationText' => FALSE,
            'amount' => FALSE,
            'quantitySold' => FALSE,
            'comments' => FALSE,
            'anonymous' => FALSE
          )
        )
      ),
      'method' => 'POST'
    ),
    // Submitting Incident.
    'setNewIncident' => array(
      'path' => array('Incident', 'NewIncident'),
      'args' => array(
        'post' => array(
          'webReferenceID' => TRUE,
          'status' => FALSE,
          'onlinePartnerID' => FALSE,
          'onlineType' => FALSE,
          'onlineFirstName' => FALSE,
          'onlineMiddleName' => FALSE,
          'onlineSurname' => FALSE,
          'onlineDialectName' => FALSE,
          'onlineSalutationCode' => FALSE,
          'onlineJobTitleCode' => FALSE,
          'onlineCompName' => FALSE,
          'onlineCompName2' => FALSE,
          'onlineAdressAdditionType' => FALSE,
          'onlineAddrAddFirstName' => FALSE,
          'onlineAddrAddSurname' => FALSE,
          'onlineAddrAddSalCode' => FALSE,
          'onlineAddrAddJobTitleCode' => FALSE,
          'onlineStreet' => FALSE,
          'onlineHouseNo' => FALSE,
          'onlineAdress2' => FALSE,
          'onlineAdress3' => FALSE,
          'onlineDepartment' => FALSE,
          'onlinePostCode' => FALSE,
          'onlineCity' => FALSE,
          'onlineCountryCode' => FALSE,
          'onlinePOBox' => FALSE,
          'onlinePOBoxPostCode' => FALSE,
          'onlineRegionID' => FALSE,
          'onlineTerritoryCode' => FALSE,
          'onlinePOBoxCountryCode' => FALSE,
          'onlineEmailPrivate' => FALSE,
          'onlinePhonePrivate' => FALSE,
          'onlineMobilePhoneNo' => FALSE,
          'onlineFaxNo' => FALSE,
          'onlineLanguageCode' => FALSE,
          'onlinePrevDonated' => FALSE,
          'onlineChildID' => FALSE,
          'onlineChildCountryCode' => FALSE,
          'onlineChildGender' => FALSE,
          'onlineChildAge' => FALSE,
          'onlineRegionCode' => FALSE,
          'onlineMotivationCode' => FALSE,
          'onlineAmount' => FALSE,
          'onlineFrequency' => FALSE,
          'onlineCollectionDate' => FALSE,
          'onlinePaymentMeth' => FALSE,
          'onlineBankBranchNo' => FALSE,
          'onlineBankAccNo' => FALSE,
          'onlineSWIFTCode' => FALSE,
          'onlineIBAN' => FALSE,
          'onlineCreditCardNo' => FALSE,
          'onlineCrCardHolder' => FALSE,
          'onlineCrCardExMonth' => FALSE,
          'onlineCrCardSecNo' => FALSE,
          'onlineMotivationText' => FALSE,
          'onlineCrCardExYear' => FALSE,
          'onlineSalutationDescr' => FALSE,
          'onlineRegionDescr' => FALSE,
          'onlineEmailBusiness' => FALSE,
          'onlinePhoneBusiness' => FALSE,
          'preferredPhoneNo' => FALSE,
          'preferredEmail' => FALSE,
          'onlineBankAccountHolder' => FALSE,
          'paidOnline' => FALSE,
          'externalReferenceNumber' => FALSE,
          'portalAccountID' => FALSE,
          'productCode' => FALSE,
          'incidentType' => FALSE,
          'comments' => FALSE,
          'onlineAddressType' => FALSE,
          'onlineEmail' => FALSE,
          'onlineSalutation' => FALSE,
          'onlineRegionPartner' => FALSE,
          'onlineAddrAddSal' => FALSE,
          'emailType' => FALSE,
          'phoneType1' => FALSE,
          'phoneType2' => FALSE,
          'mobilePhoneType' => FALSE,
          'faxType' => FALSE,
          'onlineBirthDate' => FALSE,
          'onlineExtAddrNo' => FALSE,
          'onlinePaymentID' => FALSE,
          'onlinePartnerBankAcc' => FALSE,
          'nationalBank' => FALSE,
          'bankOrCreditCard' => FALSE,
          'onlineCrCardStartMonth' => FALSE,
          'onlineCrCardStartYear' => FALSE,
          'onlineCrCardType' => FALSE,
          'onlinePOBoxCity' => FALSE
        )
      ),
      'method' => 'POST'
    ),
    // Media Services.
    // Child Media URL.
    'getChildMediaURL' => array(
      'path' => array('Media', 'ChildMedia'),
      'args' => array(
        'childID' => TRUE,
        'contentType' => TRUE,
        'mediaCode' => TRUE,
        'derivative' => TRUE,
        'status' => TRUE
      ),
      'method' => 'GET'
    ),
    // Project Media URL.
    'getProjectMediaURL' => array(
      'path' => array('Media', 'ProjectMedia'),
      'args' => array(
        'projectCode' => TRUE,
        'contentType' => FALSE,
        'mediaCode' => FALSE,
        'derivative' => FALSE,
        'status' => FALSE
      ),
      'method' => 'GET'
    ),
    // Child Multi Media URL.
    'getChildMultiMedia' => array(
      'path' => array('Media', 'ChildMultiMedia'),
      'args' => array(
        'childID' => TRUE,
        'contentType' => TRUE,
        'mediaCode' => TRUE,
        'derivative' => TRUE,
        'status' => TRUE
      ),
      'method' => 'GET'
    ),
    // Project Media URL With Caption.
    'getProjectMediaCaption' => array(
      'path' => array('Media', 'ProjectMedia/WithCaption'),
      'args' => array(
        'projectCode' => TRUE,
        'contentType' => TRUE,
        'mediaCode' => TRUE,
        'derivative' => TRUE,
        'status' => TRUE
      ),
      'method' => 'GET'
    ),
    // Project Media List.
    'getProjectMedia' => array(
      'path' => array('Media', 'ProjectMedia/All'),
      'args' => array(
        'projectCode' => TRUE,
        'contentType' => TRUE,
        'mediaCode' => TRUE,
        'derivative' => TRUE,
        'status' => TRUE
      ),
      'method' => 'GET'
    ),
    // Project Media List.
    'getAllProjectMedia' => array(
      'path' => array('Media', 'ProjectMedia'),
      'args' => array(
        'projectCode' => TRUE,
      ),
      'method' => 'GET'
    ),
    // Submitting an Enquiry.
    'setEnquiry' => array(
      'path' => array('Enquiry', 'NewEnquiry'),
      'args' => array(
        'onlineType' => array(0, 1),
        //@todo No Error Handling if user miss this parameter.
        'post' => array(
          'webReferenceID' => TRUE,
          'incidentType' => FALSE,
          'enquiryType' => FALSE,
          'languageCode' => FALSE,
          'partnerID' => FALSE,
          'firstName' => FALSE,
          'lastName' => FALSE,
          'initial' => FALSE,
          'email' => FALSE,
          'phone' => FALSE,
          'salutationCode' => FALSE,
          'jobTitleCode' => FALSE,
          'compName' => FALSE,
          'compName2' => FALSE,
          'street' => FALSE,
          'houseNo' => FALSE,
          'address2' => FALSE,
          'address3' => FALSE,
          'department' => FALSE,
          'postCode' => FALSE,
          'city' => FALSE,
          'countryCode' => FALSE,
          'emailBusiness' => FALSE,
          'mobilePhone' => FALSE,
          'phoneBusiness' => FALSE,
          'faxNo' => FALSE,
          'preferredPhoneNo' => FALSE,
          'preferredEmail' => FALSE,
          'portalAccountID' => FALSE,
          'enquiryContent' => FALSE,
          'externalReferenceNumber' => FALSE,
          'partnerSSN' => FALSE,
          'partnerProfiles' => array(
            'questionCode' => FALSE,
            'lineNo' => FALSE
          )
        )
      ),
      'method' => 'POST'
    ),
    //list of languages
    'getChildLanguages' => array(
      'path' => array('sponsorchild', 'languages'),
      'args' => array(),
      'method' => 'GET'
    ),
    //list of genders for children
    'getChildGenders' => array(
      'path' => array('sponsorchild', 'genders'),
      'languageCode' => TRUE,
      'args' => array(),
      'method' => 'GET'
    ),
    //list of countries
    'getChildCountries' => array(
      'path' => array('sponsorchild', 'countries'),
      'languageCode' => TRUE,
      'args' => array(),
      'method' => 'GET'
    ),
    //number of children in of a given Project ID
    'getProjectSponsorChildrenStatistics' => array(
      'path' => array('sponsorchild', 'statistics'),
      'args' => array(
        'projectCode' => TRUE
      ),
      'method' => 'GET'
    ),
    //the gift categories
    'getGiftCategories' => array(
      'path' => array('gift', 'categories'),
      'args' => array(
        'languageCode' => TRUE,
      ),
      'method' => 'GET'
    ),
    //details for the gift
    'getGift' => array(
      'path' => array('gift'),
      'languageCode' => TRUE,
      'args' => array(
        'iVisionID' => TRUE
      ),
      'method' => 'GET'
    ),
    //return gifts within the specified category
    'getGiftsforCategory' => array(
      'path' => array('gift/GiftsForCategory'),
      'args' => array(
        'languageCode' => TRUE,
        'GiftCategory' => TRUE
      ),
      'method' => 'GET'
    ),
    //gifts that are in the given price range
    'getGiftsforPriceRange' => array(
      'path' => array('gift', 'giftsForRange'),
      'args' => array(
        'languageCode' => TRUE,
        'lowerPrice' => FALSE, //Valid decimal
        'UpperPrice' => FALSE //Greater than lower price
      ),
      'method' => 'GET'
    ),
    //return a number of gifts in the same category
    'getRelatedGiftsforCategory' => array(
      'path' => array('gift', 'relatedGiftsForCategory'),
      'args' => array(
        'siteID' => TRUE,
        'languageCode' => TRUE,
        'giftCategory' => TRUE,
        'FilterID' => TRUE, //Can be zero
        'maxNumberToReturn' => FALSE  //integer
      ),
      'method' => 'GET'
    ),
    //return the details of a donation program
    'getDonationPrograms' => array(
      'path' => array('donation'),
      'languageCode' => TRUE,
      'args' => array(
        'iVisionID' => FALSE,
      ),
      'method' => 'GET'
    ),
    //return partner information given a partner ID
    'getPartnerById' => array(
      'path' => array('user'),
      'args' => array(
        'partnerID' => TRUE,
      ),
      'method' => 'GET'
    ),
    //To load only part of the partner :: return partner information given a partner ID
    'getPartnerSpecial' => array(
      'path' => array('user'),
      'args' => array(
        'partnerID' => TRUE,
        'loadHasPendingOrder' => TRUE,
        //Y or y load, otherwise not load
        'loadHasPendingContactInfo' => TRUE,
        // Y or y load, otherwise not load
        'loadHasPendingPaymentUpdate' => TRUE,
        //Y or y load, otherwise not load
        'loadHasPendingLumpSumPayment' => TRUE,
        //Y or y load, otherwise not load
        'loadPartnerStatus' => TRUE,
        //Y or y load, otherwise not load
        'loadAddressAddition' => TRUE
        //, Y or y load, otherwise not load
      ),
      'method' => 'GET'
    ),
    //return partner information given a portal account ID
    'getPartnerByPortalAccountID' => array(
      'path' => array('user', 'PortalAccount'),
      'args' => array(
        'portalAccountID' => TRUE,
      ),
      'method' => 'GET'
    ),
    //return payment history for the partner from on or after the supplied cut-off date
    'getPaymentHistory' => array(
      'path' => array('user', 'paymentHistory'),
      'args' => array(
        'partnerID' => TRUE,
        'cutoff' => TRUE
      ),
      'method' => 'GET'
    ),
    // return the partner’s ongoing givings.
    'getOngoingGivings' => array(
      'path' => array('user', 'ongoingGivings'),
      'args' => array(
        'partnerID' => TRUE,
      ),
      'method' => 'GET'
    ),
    // return Partner Titles.
    'getPartnerTitles' => array(
      'path' => array('user', 'titles'),
      'args' => array(),
      'method' => 'GET'
    ),
    // return Partner Countries.
    'getPartnerCountries' => array(
      'path' => array('user', 'countries'),
      'args' => array(),
      'method' => 'GET'
    ),
    // return Partner Salutations.
    'getPartnerSalutations' => array(
      'path' => array('user', 'salutations'),
      'args' => array(),
      'method' => 'GET'
    ),
    // return Partner My Sponsored Children.
    'getPartnerMySponsoredChildren' => array(
      'path' => array('user', 'mySponsoredChildren'),
      'args' => array(
        'partnerID' => TRUE,
        'languageCode' => TRUE
      ),
      'method' => 'GET'
    ),
    //Returns list of sponsor IDs and Email addresses by createDate or lastModifiedDate
    'getPartnerBaseInfoList' => array(
      'path' => array('user', 'partnerIDs'),
      'args' => array(
        'date' => TRUE,
        // format yyyy-mm-dd
        'isNew' => TRUE,
        // 1 return list which Createddate >= date, 0 return list which LastModifiedDate >= date
        'typeID' => TRUE
        // , 0 All, 1 Only Partners with an active child sponsorship, 2 Only Partners with an inactive child sponsorship, 3 combination of 2 and 3
      ),
      'method' => 'GET'
    ),
    // return a specific Partner Payment Methods
    'getPaymentMethods' => array(
      'path' => array('user', 'paymentMethods'),
      'args' => array(
        'partnerID' => TRUE,
        'languageID' => TRUE
      ),
      'method' => 'GET'
    ),
    // return a specific Partner Payment Accounts
    'getPaymentAccounts' => array(
      'path' => array('user', 'paymentAccounts'),
      'args' => array(
        'partnerID' => TRUE,
        'languageID' => TRUE
      ),
      'method' => 'GET'
    ),
    // return a specific Partner Payment Accounts
    'setDonorInfo' => array(
      'path' => array('user', 'updateDonorInfo'),
      'args' => array(
        'onlineType' => TRUE,
        'post' => array(
          'webReferenceID' => FALSE,
          'partnerID' => FALSE,
          'portalAccountID' => FALSE,
          'firstName' => FALSE,
          'middleName' => FALSE,
          'surname' => FALSE,
          'salutationCode' => FALSE,
          'jobTitleCode' => FALSE,
          'compName' => FALSE,
          'compName2' => FALSE,
          'street' => FALSE,
          'houseNo' => FALSE,
          'address2' => FALSE,
          'address3' => FALSE,
          'department' => FALSE,
          'postCode' => FALSE,
          'city' => FALSE,
          'countryCode' => FALSE,
          'POBox' => FALSE,
          'POBoxPostCode' => FALSE,
          'region' => FALSE,
          'regionID' => FALSE,
          'territoryCode' => FALSE,
          'POBoxCountryCode' => FALSE,
          'preferredPhoneNo' => FALSE,
          'phonePrivate' => FALSE,
          'phoneBusiness' => FALSE,
          'mobilePhoneNo' => FALSE,
          'faxNo' => FALSE,
          'preferredEmail' => FALSE,
          'emailPrivate' => FALSE,
          'languageCode' => FALSE,
          'prevDonated' => FALSE,
          'motivationText' => FALSE,
          'partnerSSN' => FALSE,
          'externalReferenceNumber' => FALSE,
          'comments' => FALSE,
          'additionalMembers' => array(
            'name' => FALSE,
            'address' => FALSE,
            'address2' => FALSE,
            'postCode' => FALSE,
            'city' => FALSE,
            'regionID' => FALSE,
            'countryCode' => FALSE,
            'email' => FALSE,
            'birthdate' => FALSE,
            'salutationCode' => FALSE,
            'salutationDescription' => FALSE,
            'phoneNumber' => FALSE
          ),
          'commPreferences' => array(
            'category' => FALSE,
            'option' => FALSE,
            'choice' => FALSE,
          ),
          'payments' => array(
            'collectionDate' => FALSE,
            'paidOnline' => FALSE,
            'externalReferenceNumber' => FALSE,
            'paymentMethod' => FALSE,
            'frequency' => FALSE,
            'bankName' => FALSE,
            'custBankAccSSN' => FALSE,
            'bankAccountHolder' => FALSE,
            'bankBranchNo' => FALSE,
            'bankCode' => FALSE,
            'bankAccNo' => FALSE,
            'ABI' => FALSE,
            'BBAN' => FALSE,
            'CAB' => FALSE,
            'transitNo' => FALSE,
            'bankIDNo' => FALSE,
            'oeNBRegistrationNo' => FALSE,
            'SWIFT' => FALSE,
            'IBAN' => FALSE,
            'creditCardType' => FALSE,
            'creditCardNo' => FALSE,
            'crCardSecNo' => FALSE,
            'crCardHolder' => FALSE,
            'crCardExMonth' => FALSE,
            'crCardExYear' => FALSE,
            'pledgeID' => FALSE,
            'amount' => FALSE
          ),
          'lumpSums' => array(
            'onlineMotivationText' => FALSE,
            'amount' => FALSE,
            'paidOnline' => FALSE
          ),
          'partnerProfiles' => array(
            'questionCode' => FALSE,
            'lineNo' => FALSE
          ),
        )
      ),
      'method' => 'POST'
    ),
    // return Step Wise Child
    'getStepWiseChild' => array(
      'path' => array('user', 'stepWiseChild'),
      'args' => array(
        'siteID' => TRUE,
        'languageCode' => TRUE,
        'childID' => TRUE, //Stepwise child ID or SD Child ID
      ),
      'method' => 'GET'
    ),
    // return Step Wise Child based on parameter
    'getStepWiseChildSpecial' => array(
      'path' => array('user', 'stepWiseChild'),
      'args' => array(
        'siteID' => TRUE,
        'languageCode' => TRUE,
        'childID' => TRUE, //Stepwise child ID or SD Child ID,
        'loadFamilyMembers' => TRUE,
        'loadChildParticipations' => TRUE,
        'loadFamilyParticipations' => TRUE,
        'loadChildSupports' => TRUE,
        'loadFamilySupports' => TRUE,
        'loadCorrespondences' => TRUE,
        'loadVocationalTrainings' => TRUE
      ),
      'method' => 'GET'
    ),
    // return the gift cards information from iVision
    'getGiftCardsByGiftCatalogueID' => array(
      'siteID' => TRUE,
      'path' => array('GiftCardByGiftID'),
      'args' => array(
        'GiftCatalogueID' => TRUE,
        'languageCode' => TRUE,
      ),
      'method' => 'GET'
    ),
    // return the gift cards information from iVision
    'getGiftCardsByGiftCardID' => array(
      'siteID' => TRUE,
      'path' => array('GiftCardByID'),
      'args' => array(
        'GiftCardID' => TRUE,
        'languageCode' => TRUE,
      ),
      'method' => 'GET'
    ),
    // return the gift cards images information from iVision
    'getGiftCardsImagesByGiftCardID' => array(
      'path' => array('giftCardImagesByID'),
      'args' => array(
        'languageCode' => TRUE,
        'giftCardID' => TRUE,
        'height' => TRUE,
        'width' => TRUE
      ),
      'method' => 'GET'
    ),
    // return the Interaction information from iVision.
    'getInteractionInformation' => array(
      'path' => array('interactionInfo'),
      'args' => array(
        'partnerID' => TRUE,
        'templateCode' => TRUE,
        'subjectCode' => TRUE,
        //can be zero
        'startingID' => TRUE,
        //can be zero, it’s[Entry No_] value of [Interaction Log Entry] table
        'maxToReturn' => TRUE,
        //can be zero
        'fromDate' => TRUE
        //format yyyy-mm-dd
      ),
      'method' => 'GET'
    ),
    //return partner information given a TypeID.
    'getPartnerInformationList' => array(
      'path' => array('user'),
      'args' => array(
        'typeID' => TRUE,
        //1- By Email, 2- By Phone Number or Mobile Number, 3 – By Name, 4 – By First Name, 5 – By Surname, 6 – By VAT Registration No, 7 – By Birth Date
      ),
      'method' => 'GET'
    ),
    //return partner information given a TypeID.
    'getPartnerInformationListSpecial' => array(
      'path' => array('user'),
      'args' => array(
        'typeID' => TRUE,
        //1- By Email, 2- By Phone Number or Mobile Number, 3 – By Name, 4 – By First Name, 5 – By Surname, 6 – By VAT Registration No, 7 – By Birth Date
        'loadHasPendingOrder' => TRUE,
        //Y or y load, otherwise not load
        'loadHasPendingContactInfo' => TRUE,
        //Y or y load, otherwise not load
        'loadHasPendingPaymentUpdate' => TRUE,
        //Y or y load, otherwise not load
        'loadHasPendingLumpSumPayment' => TRUE,
        //Y or y load, otherwise not load
        'loadPartnerStatus' => TRUE,
        //Y or y load, otherwise not load,
        'loadAddressAddition' => TRUE,
        // Y or y load, otherwise not load,
        'Values' => TRUE
        //Birth Date format is yyyy-mm-dd
      ),
      'method' => 'GET'
    ),
    //return partner Profile information given a PartnerID.
    'getPartnerProfileInformation' => array(
      'path' => array('PartnerProfile'),
      'args' => array(
        'partnerID' => TRUE,
      ),
      'method' => 'GET'
    ),
  );

  /**
   * Initialize all IVision connection Data
   *
   * @param array $api_data
   *  All IVision Webservice Connection Data (URI, language, siteID).
   * @param bool $dummy_data
   *  On default FALSE. If set TRUE all requested data will be dummy data an saved local.
   * @throws IVisionException
   *  Throws exception if parameter is missing
   *  'API URI is missing'
   *  'API language is missing'
   *  'siteID ist missing'
   */
  public function __construct($api_data = array(), $dummy_data = FALSE) {
    if ($dummy_data === TRUE) {
      $api_data['uri'] = '';
      $api_data['language'] = '';
      $api_data['siteID'] = '';
    }
    else {
      if (!isset($api_data['uri'])) {
        throw new IVisionException('API URI is missing');
      }
      if (!isset($api_data['language'])) {
        throw new IVisionException('API language is missing');
      }
      if (!isset($api_data['siteID'])) {
        throw new IVisionException('siteID ist missing');
      }
    }

    $this->dummy_data = $dummy_data;
    $this->api_data = $api_data;
  }

  /**
   * First Build the API call URI and calls the processArgsList() to process the $args array
   * Calls the apiRequest() Method to get or set the IVision Data.
   *
   * @param $api_call
   *  API function name.
   * @param $args
   *  List of arguments so set up the API Call.
   * @return array
   *  List of requested IVision Data.
   * @throws IVisionException
   *  "unknown API call: XYZ":                    Magic function name could not be found in the $api_calls array.
   *  "missing argument array":                   $args parameter is not be set.
   */
  public function __call($api_call, $args = array()) {

    $args = $args[0];

    // save the name of the used function to the log array.
    unset($this->log);
    $this->log['api_function'] = $api_call;
    $this->log['api_function_args'] = $args;

    // Checks if the function name is a valid api call and isset args array
    if (isset($this->api_calls[$api_call]) && isset($api_call)) {
      $api_call_mask = $this->api_calls[$api_call];
    }
    else {
      throw new IVisionException('unknown API call: ' . $api_call);
    }
    if (!isset($args) || !is_array($args)) {
      throw new IVisionException('missing argument array');
    }

    // Building dynamical the requestURI for the API Call based on the array mask
    // If siteID isset we switch the path with the siteID. Do not know why this is changing.. :)
    if(isset($api_call_mask['siteID']) && $api_call_mask['siteID'] === TRUE){
      $this->api_call_uri = $this->api_data['uri'] . 'api/' . $this->api_data['siteID']  . '/' . $api_call_mask['path'][0];
    }else{
      $this->api_call_uri = $this->api_data['uri'] . 'api/' . $api_call_mask['path'][0] . '/' . $this->api_data['siteID'];
    }


    // Sets the API language if necessary.
    if (isset($api_call_mask['languageCode']) && $api_call_mask['languageCode'] === TRUE) {
      $this->api_call_uri .= '/' . $this->api_data['language'];
    }

    if (isset($api_call_mask['path'][1])) {
      $this->api_call_uri .= '/' . $api_call_mask['path'][1];
    }

    $this->processArgsList($api_call_mask['args'], $args);


    if ($this->dummy_data) {
      return $this->dummyDataRequest($api_call, $args);
    }
    else {
      return $this->apiRequest($api_call_mask['method']);
    }
  }

  /**
   * First Build the API call URI with all given arguments and check the parameters against the mask array.
   * Function walks recursive trough the mask array.
   *
   * @param array $mask
   *  API call mask for the requested function.
   * @param $args
   *  List of requested IVision Data.
   * @param bool $jsonBody
   *  Default FALSE. If set TRUE the args list will be rendered to request a POST call.
   * @throws IVisionException
   *  "necessary argument missing or empty: XYZ": Check against the $api_calls array mask failed parameter have to be set.
   *  "empty argument: XYZ":                      Optional $args value is empty.
   *  "wrong or empty argument: XYZ":             $args array list is empty or wrong value.
   */
  private function processArgsList($mask = array(), $args = array(), $jsonBody = FALSE) {

    // Check if one parameter cant be find in the $mask array. Prevent Typo Errors.
//    foreach ($args as $key => $value) {
//      if (!array_key_exists($key, $mask)) {
//        throw new IVisionException('argument cant be find in the mask array: ' . $key);
//      }
//    }

    foreach ($mask as $key => $value) {

      if($key == 'languageCode') $args[$key] = $this->api_data['language'];

      // Parameters that have to be set
      if ($value === TRUE) {
        if (isset($args[$key]) && $args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new IVisionException('necessary argument missing or empty: ' . $key);
        }
      }
      // Parameters which are optional.
      elseif ($value === FALSE && isset($args[$key])) {
        if ($args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new IVisionException('empty argument: ' . $key);
        }
      }
      // Static path list that have to be set.
      elseif (is_array($value) && !$this->isAssoc($value)) {
        if (in_array($args[$key], $value) && $args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new IVisionException('wrong or empty argument: ' . $key . ' ' . $args[$key]);
        }
      }
      // Render the json body string for a POST Requests.
      elseif (is_array($value) && $this->isAssoc($value)) {

        if ($jsonBody === FALSE && !isset($args['post']) && $args['post'] !== '') {
          throw new IVisionException('necessary argument missing or empty: ' . $key . ' ' . $args[$key]);
        }
        else {
          // Expand the $args array to validate, that no other parameters have to be set in other dimensions in the array.
          if (!isset($args[$key]) || !is_array($args[$key])) {
            $args[$key] = array();
          }
          // Recursive function call to check all dimensions of the $args array.
          $this->processArgsList($value, $args[$key], TRUE);
          // If Recursive function call finished the checked POST values will be saved.
          if ($key === 'post') {
            $this->api_call_post = $args;
          }
        }
      }
    }
  }

  /**
   * Checks if an array is associative
   *
   * @param $arr
   *  array have to be checked
   * @return bool
   *  return true if array is associative
   */
  private function isAssoc($arr) {
    return array_keys($arr) !== range(0, count($arr) - 1);
  }

  /**
   * Returns dummy data from local json files. POST requests will write custom json files.
   * Custom json files will be used if they exist (for example: apiCallName.custom.json).
   *
   * @param $api_call
   *  API function name.
   * @param $args
   *  List of arguments so set up the API Call.
   * @return array List of requested IVision dummy data.
   * List of requested IVision dummy data.
   * @throws \IVisionException
   *  Checks if the files could be opened or created.
   */
  private function dummyDataRequest($api_call, $args) {

    // builds $path and $filename variables.
    $data = '';
    $path = drupal_get_path('module', 'wovi_ivision') . '/dummydata/';
    $filename = $api_call;
    if (isset($args['type'])) {
      $filename .= '.' . $args['type'];
    }

    $filename_custom = $filename . '.custom.json';
    $filename .= '.json';

    // If custom json files exist, they will be taken as default data.
    if (file_exists($path . $filename_custom)) {
      $filename = $filename_custom;
    }

    // read the json data.
    $file_src = fopen($path . $filename, 'r');
    if ($file_src === FALSE) {
      throw new IVisionException('Error: Could not open file: ' . $filename);
    }


    if ($this->api_calls[$api_call]['method'] == 'GET') {
      // If it is a GET request the data will be returned.
      $data = fread($file_src, filesize($path . $filename));
    }
    elseif ($this->api_calls[$api_call]['method'] == 'POST') {
      // If it is a POST request the old json file and the new data will be merged.
      $data = fread($file_src, filesize($path . $filename));
      $data = json_decode($data, TRUE);
      $data = array_replace_recursive($data, $args['post']);
      fclose($file_src);

      // The merged data will be written in the custom json file.
      $file_src = fopen($path . $filename_custom, 'w');
      if ($file_src === FALSE) {
        throw new IVisionException('Error: Could not open or create file: ' . $filename);
      }
      if (!defined('JSON_PRETTY_PRINT')) {
        define('JSON_PRETTY_PRINT', 0);
      }
      fwrite($file_src, json_encode($data, JSON_PRETTY_PRINT));
      fclose($file_src);

      $data = TRUE;
    }
    $this->log = array('dummyData' => TRUE);

    // Fix to Return the Data always in the same structure.
    if (substr($data, 0, 1) == '[') {
      return json_decode($data, TRUE);
    }
    else {
      $results = json_decode($data, TRUE);
      return array($results);
    }
  }

  /**
   * Send the Request via curl to the World Vision IVision Webservice and returns the Result.
   * Checks if the the call is a POST or GET request and saves the HEAD information to the private $log.
   *
   * @param $method
   *  Request Type of the API call
   * @return array
   *  List of requested IVision Data.
   * @throws IVisionException
   *  "Curl Error: XYZ":                                  Any possible thrown curl error.
   *  "API call (URI) failed. Response Code: 400 - 500":  Returns the HTTP Code if it is not 200 or 201.
   */
  private function apiRequest($method) {
    $uri = $this->api_call_uri;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 500); // @todo have to be changed
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if ($method == 'POST') {
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->api_call_post, JSON_NUMERIC_CHECK));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }
    $curl_result = curl_exec($ch);
    $curl_header = curl_getinfo($ch);


    if (curl_errno($ch)) {
      throw new IVisionException('Curl Error: ' . curl_error($ch));
    }

    curl_close($ch);

    // Saves the HEAD Request info to the $log
    $this->log = array_merge($this->log, $curl_header);

    if ($curl_header['http_code'] != 200 && $curl_header['http_code'] != 201) {

      throw new IVisionException('API call (' . $uri . ') failed. Response Code: ' . $curl_header['http_code'] . ' - ' . $curl_result);
    }


    // Fix to Return the Data always in the same structure.
    //    if (substr($curl_result, 0, 1) == '[') {
    //      return json_decode($curl_result, TRUE);
    //    }
    //    else {
    //      $results = json_decode($curl_result, TRUE);
    //      return array($results);
    //    }

    return json_decode($curl_result, TRUE);

  }

  /**
   * Returns the HEAD Request info from the last API call.
   *
   * @return array
   *  List of all HEAD information from the last API call.
   */
  public function lastRequestLog() {
    return $this->log;
  }

  /**
   * Returns the API calls mask. It could be requested the whole array or just one function name.
   *
   * @param null $api_call
   *  Specific function name.
   * @return array
   *  Returns a single mask of the API calls or the mask of all API calls
   * @throws IVisionException
   *  'unknown function' : If no function with this name exists, this Exception is thrown.
   */
  public function getApiCallMask($api_call = NULL) {
    if ($api_call === NULL) {
      return $this->api_calls;
    }
    elseif (isset($this->api_calls[$api_call])) {
      return $this->api_calls[$api_call]['args'];
    }
    else {
      throw new IVisionException('unknown function');
    }
  }

}
