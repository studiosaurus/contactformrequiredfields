<?php
/**
 * Contact Form Required Fields plugin for Craft CMS
 *
 * Adds required fields to the Contact Form Plugin
 *
 * @author    Stephen Bowling
 * @copyright Copyright (c) 2016 Stephen Bowling
 * @link      https://stephenbowling.com
 * @package   ContactFormRequiredFields
 * @since     1.0.0.
 */

namespace Craft;

class ContactFormRequiredFieldsPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        craft()->on('contactForm.onBeforeSend', function(Event $event) {
            /**
             * fromEmail - value of `fromEmail` field (required)
             * fromName - value of `fromName` field (optional)
             * subject - subject of email to send
             * messageFields - array of fields in message
             * message - string containing body of message
             */
            $message = $event->params['message'];

            /**
             * To determine form validation rules, the ID of the entry
             * used to create the form should be submitted along with the form
             */
            $formId = craft()->request->getPost('formId');
            $formId = craft()->security->validateData($formId);

            /**
             * Get the form entry using the ID
             */
            if ($formId)
            {
                $formEntry = craft()->entries->getEntryById($formId);
            }

            if ($formEntry)
            {
                /**
                 * The Matrix used to create the fields
                 */
                $formFields = $formEntry->fieldBlocks;

                /**
                 * An array to keep track of any fields marked required
                 */
                $requiredFields = array();

                /**
                 * Loop through each block on the entry the form was created
                 * on and if the block has a `required` field set to `true`
                 * add the field's label to the `requiredFields` array
                 */
                foreach ($formFields as $formField) {
                    if (isset($formField->required) && $formField->required == true)
                    {
                        $requiredFields[] = $formField->label;
                    }
                }

                /**
                 * If we've determined there are required fields on this form,
                 * loop through the required fields and make sure the required
                 * exists and fields aren't blank
                 */
                foreach ($requiredFields as $requiredField) {

                    if (!array_key_exists($requiredField, $message['messageFields'])|(array_key_exists($requiredField, $message['messageFields']) && $message['messageFields'][$requiredField] == ""))
                    {
                        /**
                         * If a required field is blank add an error to
                         * the message and set $isValid to false
                         */
                        $message->addError($requiredField, $requiredField.' is required');

                        $event->isValid = false;
                    }
                }

            }
            else
            {
                $event->isValid = false;
            }

        });
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Contact Form Required Fields');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Adds required fields to the Contact Form Plugin');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0.';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0.';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Stephen Bowling';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://stephenbowling.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

}
