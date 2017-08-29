<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRT3Tables extends Migration
{
    public function up()
    {
        Schema::connection('rt3')->create('achieverstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('activity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACTIVITYTYPEID')->index();
            $table->bigInteger('ACTIVITYSTATUSID')->index();
            $table->bigInteger('ACTIVITYACCESSTYPEID')->default(1)->index();
            $table->date('STARTDATE')->index();
            $table->time('STARTTIME')->nullable();
            $table->date('ENDDATE')->nullable();
            $table->time('ENDTIME')->nullable();
            $table->string('SUMMARY', 500)->nullable();
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->smallInteger('NUMVAL1')->nullable()->default(0);
        });

        Schema::connection('rt3')->create('achieverhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACHIEVERSTATUSID');
            $table->bigInteger('EMPLOYEEID')->index();
            $table->date('DATE')->index();
            $table->unique([ 'ACHIEVERSTATUSID', 'EMPLOYEEID', ]);
        });

        Schema::connection('rt3')->create('activityvisitorlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('ACTIVITYID')->index();
            $table->unique([ 'PERSONID', 'ACTIVITYID', ]);
        });

        Schema::connection('rt3')->create('activitytype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACTIVITYCONTEXTID')->index();
            $table->string('ITEM');
            $table->integer('SORTPRIORITY')->default(0);
            $table->string('SYSTEMUSE', 1)->default('n');
            $table->unique([ 'ITEM', 'ACTIVITYCONTEXTID', ]);
        });

        Schema::connection('rt3')->create('activitystatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('activitypersonlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('ACTIVITYID')->index();
            $table->unique([ 'PERSONID', 'ACTIVITYID', ]);
        });

        Schema::connection('rt3')->create('activityhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACTIVITYID')->index();
            $table->string('COMMENT', 200);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('activitycontext', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25);
        });

        Schema::connection('rt3')->create('activityagentlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('ACTIVITYID')->index();
            $table->unique([ 'AGENTLISTID', 'ACTIVITYID', ]);
        });

        Schema::connection('rt3')->create('activityaccesstype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('assistedsale', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('agentsellerlistreferral', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTREFERRALID');
            $table->bigInteger('AGENTLISTID')->index();
            $table->bigInteger('AGENTLISTTYPEID')->index();
            $table->unique([ 'SELLERLISTREFERRALID', 'AGENTLISTID', ]);
        });

        Schema::connection('rt3')->create('agentsellerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID')->index();
            $table->bigInteger('SELLERLISTID');
            $table->bigInteger('AGENTLISTTYPEID')->index();
            $table->unique([ 'SELLERLISTID', 'AGENTLISTID', ]);
        });

        Schema::connection('rt3')->create('agentsalelist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('SALEID')->index();
            $table->bigInteger('OFFICEID')->index();
            $table->bigInteger('AGENTLISTTYPEID')->index();
            $table->char('GROSSVALUETYPE', 1)->default('%');
            $table->decimal('GROSSCOMMVALUE', 11, 3)->default(0.000);
            $table->char('AGENTVALUETYPE', 1)->default('%');
            $table->decimal('AGENTCOMMVALUE', 11, 3)->default(0.000);
            $table->char('DEDUCTFRANCHISEFEE', 1)->default('n');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->unique([ 'AGENTLISTID', 'SALEID', 'AGENTLISTTYPEID', ]);
        });

        Schema::connection('rt3')->create('agentrental', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RENTALID');
            $table->bigInteger('AGENTLISTID')->index();
            $table->bigInteger('AGENTLISTTYPEID')->index();
            $table->unique([ 'RENTALID', 'AGENTLISTID', ]);
        });

        Schema::connection('rt3')->create('agentlisttype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('agentlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('OFFICEID');
            $table->bigInteger('EMPLOYEEID')->index();
            $table->bigInteger('LISTINGACCESSID')->default(1)->index();
            $table->char('LISTINGIMAGEACCESS', 1)->nullable()->default('y');
            $table->char('BUYERACCESS', 1)->nullable()->default('y');
            $table->decimal('COMMSPLIT', 5)->default(50.00);
            $table->decimal('BONDCOMMSPLIT', 5)->default(0.00);
            $table->char('LETTINGAGENT', 1)->nullable()->default('n');
            $table->char('LISTINGAGENT', 1)->nullable()->default('y');
            $table->char('ACTIVE', 1)->nullable()->default('y')->index();
            $table->char('DEDUCTFRFEE', 1)->nullable()->default('y');
            $table->char('OFFICEADMIN', 1)->nullable()->default('n');
            $table->char('P24AGENTID', 6)->nullable();
            $table->char('PgenieAgentId', 6)->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->char('NotifySaleSuspensive', 1)->default('n');
            $table->char('NotifySaleFinal', 1)->default('n');
            $table->char('NotifySaleClose', 1)->default('n');
            $table->char('NotifySaleActivitiesExpire', 1)->default('y');
            $table->char('RAP', 1)->default('y');
            $table->char('NotifyRAP', 1)->default('y');
            $table->char('NotifyReferral', 1)->default('y');
            $table->char('DEFAULTOFFICE', 1)->default('y');
            $table->char('SALEACCESS', 1)->default('y');
            $table->char('LISTINGREPORTACCESS', 1)->default('y');
            $table->char('BUYERREPORTACCESS', 1)->default('y');
            $table->char('RAPREPORTACCESS', 1)->default('n');
            $table->char('SALEREPORTACCESS', 1)->default('y');
            $table->char('REFERRALREPORTACCESS', 1)->default('n');
            $table->char('NOTIFYWEBSMSNOTIFICATION', 1)->default('n');
            $table->unique([ 'OFFICEID', 'EMPLOYEEID', ]);
        });

        Schema::connection('rt3')->create('agentbuyerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('BUYERLISTID')->index();
            $table->bigInteger('AGENTLISTTYPEID')->default(1)->index();
            $table->unique([ 'AGENTLISTID', 'BUYERLISTID', 'AGENTLISTTYPEID', ]);
        });

        Schema::connection('rt3')->create('advertisingsourcetype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('advertisingsourceitem', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 45)->unique();
        });

        Schema::connection('rt3')->create('advertisingsource', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ADVERTISINGSOURCETYPEID');
            $table->bigInteger('ADVERTISINGSOURCEITEMID')->index();
            $table->bigInteger('PROVINCEID')->index();
            $table->unique([ 'ADVERTISINGSOURCETYPEID', 'ADVERTISINGSOURCEITEMID', 'PROVINCEID', ]);
        });

        Schema::connection('rt3')->create('advertisingagentlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('ADVERTISINGID')->index();
            $table->decimal('COST', 11, 3);
            $table->unique([ 'AGENTLISTID', 'ADVERTISINGID', ]);
        });

        Schema::connection('rt3')->create('advertising', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('OFFICEID')->index();
            $table->bigInteger('ADVERTISINGSOURCEID')->index();
            $table->date('DATE');
            $table->smallInteger('WEEKNO');
            $table->string('DESCRIPTION', 200)->nullable();
        });

        Schema::connection('rt3')->create('awarddescription', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->integer('SORTORDER')->default(1);
            $table->string('AWARDTYPE', 20)->default('agent');
            $table->string('ITEM', 200)->unique();
        });

        Schema::connection('rt3')->create('tradingentitytype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('tradingentityserviceprovider', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SERVICEPROVIDERTYPEID');
            $table->bigInteger('TRADINGENTITYID')->index();
            $table->unique([ 'SERVICEPROVIDERTYPEID', 'TRADINGENTITYID', ]);
        });

        Schema::connection('rt3')->create('tradingentityperson', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('TRADINGENTITYID')->index();
            $table->unique([ 'PERSONID','TRADINGENTITYID', ]);
        });

        Schema::connection('rt3')->create('tradingentity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TRADINGENTITYTYPEID')->default(1)->index();
            $table->string('NAME', 50);
            $table->string('NUMBER', 15)->nullable();
            $table->char('VATREGISTERED', 1)->nullable();
            $table->string('TEL', 20)->nullable();
            $table->string('FAX', 20)->nullable();
            $table->string('EMAIL', 60)->nullable();
            $table->string('PHYSICALADDRESS', 100)->nullable();
            $table->string('POSTALADDRESS', 500)->nullable();
            $table->string('STREETNUMBER', 25)->nullable();
            $table->string('STREETNAME', 50)->nullable();
            $table->bigInteger('PHYSICALADDRESSID')->default(1)->index();
            $table->unique([ 'NAME', 'PHYSICALADDRESSID', ]);
        });

        Schema::connection('rt3')->create('trading_times', function (Blueprint $table) {
            $table->bigInteger('LocationID');
            $table->string('DescriptionLong', 500)->nullable();
            $table->string('DayOfWeek', 450)->nullable();
            $table->string('TradingDay', 450)->nullable();
            $table->string('IsClosed', 450)->nullable();
            $table->string('StartTime', 450)->nullable();
            $table->string('EndTime', 450)->nullable();
        });

        Schema::connection('rt3')->create('title', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 5)->unique();
        });

        Schema::connection('rt3')->create('tenantsuburbs', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TENANTID');
            $table->bigInteger('SUBURBID')->index();
            $table->unique([ 'TENANTID', 'SUBURBID', ]);
        });

        Schema::connection('rt3')->create('tenantstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('tenantsellerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID')->index();
            $table->bigInteger('SELLERLISTID')->index();
            $table->date('LEASEEXPIRY')->nullable();
            $table->decimal('RENTAL', 11, 3)->nullable();
        });

        Schema::connection('rt3')->create('tenantreference', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TENANTID')->index();
            $table->bigInteger('REFERENCETYPEID')->index();
            $table->bigInteger('PERSONID')->index();
            $table->smallInteger('PERIOD')->nullable();
            $table->string('POSITION', 50)->nullable();
            $table->string('BANK', 25)->nullable();
            $table->string('RELATIONSHIP', 25)->nullable();
            $table->string('COMMENTS', 200)->nullable();
            $table->string('BANKBRANCH', 20)->nullable();
            $table->string('BANKACCOUNTNO', 20)->nullable();
        });

        Schema::connection('rt3')->create('tenantcreditcheckoptions', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TENANTID')->index();
            $table->bigInteger('CREDITCHECKOPTIONSID')->index();
        });

        Schema::connection('rt3')->create('tenantareas', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TENANTID');
            $table->bigInteger('RAWSONAREADEFINITIONID')->index();
            $table->unique([ 'TENANTID', 'RAWSONAREADEFINITIONID', ]);
        });

        Schema::connection('rt3')->create('tenant', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID')->index();
            $table->bigInteger('TENANTSTATUSID')->default(1)->index();
            $table->smallInteger('NUMOCCUPANTS');
            $table->decimal('RENTAMOUNT', 11, 3);
            $table->date('OCCUPANCYDATE');
            $table->smallInteger('LEASEPERIOD');
            $table->string('PETREQUIREMENTS', 200)->nullable();
        });

        Schema::connection('rt3')->create('suburb', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 100)->unique();
        });

        Schema::connection('rt3')->create('subjecttosale', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->decimal('REQUIREDPRICE', 12, 3)->nullable()->default(0.000);
            $table->date('EXPIRYDATE')->nullable();
            $table->date('SOLDDATE')->nullable();
            $table->decimal('SOLDPRICE', 12, 3)->nullable();
            $table->string('PHYSICALADDRESS', 100)->nullable();
            $table->bigInteger('PHYSICALADDRESSID')->nullable()->index();
        });

        Schema::connection('rt3')->create('stakeholdertype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('stakeholderstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });
        
        Schema::connection('rt3')->create('stakeholderdirectors', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID')->index();
            $table->bigInteger('STAKEHOLDERID')->index();
            $table->char('P24LEADSOPTIN', 1)->nullable()->default('n');
        });

        Schema::connection('rt3')->create('stakeholder', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('STAKEHOLDERSTATUSID')->default(1)->index();
            $table->bigInteger('STAKEHOLDERTYPEID')->default(1)->index();
            $table->bigInteger('BANKID')->default(2)->index();
            $table->string('NAME', 100)->unique();
            $table->string('COMPANYNO', 25)->nullable();
            $table->string('VATREGNO', 25)->nullable();
            $table->string('FFCNO', 11)->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->string('BANKACCOUNTNO', 20)->nullable();
            $table->string('BANKCODE', 10)->nullable();
        });

        Schema::connection('rt3')->create('stakeholder_ffchistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('STAKEHOLDERID')->index();
            $table->string('FFCNO', 10);
            $table->date('DATE');
            $table->string('COMPANYNAME', 100)->nullable();
        });

        Schema::connection('rt3')->create('showhouselog', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->date('DATE')->index();
            $table->smallInteger('VISITORNUMBER');
            $table->date('LISTDELIVERYDATE')->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('showhouseagents', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('SHOWHOUSELOGID')->index();
            $table->unique([ 'AGENTLISTID', 'SHOWHOUSELOGID',]);
        });

        Schema::connection('rt3')->create('serviceprovidertype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('sellerliststatushistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTSTATUSID')->index();
            $table->bigInteger('SELLERLISTID')->index();
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('sellerliststatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('sellerlistreferralstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('sellerlistreferralhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTREFERRALID')->index();
            $table->string('COMMENT', 400);
            $table->timestamp('created')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('sellerlistreferralactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTREFERRALID')->index();
            $table->bigInteger('ACTIVITYID')->index();
        });

        Schema::connection('rt3')->create('sellerlistreferral', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID')->index();
            $table->bigInteger('REFERRINGOFFICEID')->index();
            $table->bigInteger('REFERREDOFFICEID')->index();
            $table->bigInteger('SELLERLISTREFERRALSTATUSID')->default(1)->index();
            $table->string('COMMENTS', 400)->nullable();
            $table->string('REFERENCE', 20)->nullable();
            $table->bigInteger('SELLERLISTIDREF')->nullable();
            $table->date('EXPIRYDATE')->nullable();
            $table->char('DIRECT', 1)->default('n');
            $table->char('REFMETHODCREATED', 1)->default('n');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('sellerlistimageref', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->bigInteger('PROPERTYIMAGEREFID')->index();
            $table->integer('SORTORDER')->nullable()->default(0);
            $table->char('DISPLAY', 1)->default('y');
        });

        Schema::connection('rt3')->create('sellerlisthistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->string('COMMENT', 400);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP')->index();
        });

        Schema::connection('rt3')->create('sellerlistactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->bigInteger('ACTIVITYID')->index();
        });

        Schema::connection('rt3')->create('sellerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID')->index();
            $table->bigInteger('OFFICEID')->index();
            $table->bigInteger('MANDATETYPEID')->default(1)->index();
            $table->date('LISTDATE')->nullable()->index();
            $table->string('LISTCODE', 15)->nullable()->index();
            $table->date('EXPIRYDATE')->nullable();
            $table->decimal('LISTPRICE', 13, 3)->nullable()->default(0.000);
            $table->string('SELLINGREASON', 200)->nullable();
            $table->bigInteger('BONDINSTITUTIONID')->default(1)->index();
            $table->decimal('BONDAMOUNT', 11, 3)->nullable()->default(0.000);
            $table->string('COMMENTS', 4000)->nullable();
            $table->decimal('OFFERSFROM', 11, 3)->nullable();
            $table->date('OCCUPATIONDATERENTAL')->nullable();
            $table->date('OCCUPATIONDATE')->nullable();
            $table->string('OTHERINFO', 1000)->nullable();
            $table->string('SHORTADDRESS', 25)->nullable();
            $table->bigInteger('SELLERLISTSTATUSID')->default(1)->index();
            $table->char('FURNISHED', 1)->nullable()->default('n');
            $table->char('NHBRC', 1)->nullable()->default('n');
            $table->bigInteger('LISTINGWEBID')->index();
            $table->bigInteger('FNBID')->index();
            $table->bigInteger('P24ID')->index();
            $table->bigInteger('PGENIEID')->index();
            $table->bigInteger('RAWSONCOZAID')->index();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00')->index();
            $table->bigInteger('BUSINESSTYPEID')->default(1)->index();
            $table->char('PRICERATE', 1)->default('l');
            $table->bigInteger('IOLID')->default(1)->index();
            $table->bigInteger('PJUNCTIONID')->index();
            $table->bigInteger('ASSISTEDLISTINGID')->default(1)->index();
            $table->char('ARCHIVEIMMEDIATELY', 1)->default('n');
            $table->bigInteger('CURRENCYID')->nullable()->default(1)->index();
            $table->dateTime('SYSTEMEXPIRYDATE')->nullable()->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('seller_referals_summary', function (Blueprint $table) {
            $table->bigInteger('sellerlistreferralid')->default(0);
            $table->bigInteger('propertyid')->default(0);
            $table->string('reference', 20)->nullable();
            $table->bigInteger('fromofficeid')->default(0);
            $table->string('fromoffice', 50);
            $table->string('fromofficetel', 20);
            $table->string('fromofficelabel', 77)->default('');
            $table->string('fromagentid', 100)->nullable()->index();
            $table->text('fromagent', 16777215)->nullable();
            $table->bigInteger('toofficeid')->default(0);
            $table->string('tooffice', 50);
            $table->string('toofficetel', 20);
            $table->string('toofficelabel', 77)->default('');
            $table->string('toagentid', 100)->nullable()->index();
            $table->text('toagent', 16777215)->nullable();
            $table->dateTime('created')->default('0000-00-00 00:00:00');
            $table->string('sellername', 50)->nullable();
            $table->string('cellphone', 20);
            $table->string('email', 60)->nullable();
            $table->bigInteger('statusid')->default(0);
            $table->string('status', 20);
            $table->string('physicaladdress', 100);
            $table->bigInteger('activitycount')->nullable();
            $table->dateTime('summary_created')->default('0000-00-00 00:00:00');
            $table->char('direct', 1)->default('n');
            $table->dateTime('expirydate')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('salestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 10)->unique();
        });

        Schema::connection('rt3')->create('salesalestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALESTATUSID')->index();
            $table->bigInteger('SALEID')->index();
            $table->date('DATE')->index();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('saleotherservicesoption', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('saleofficereferral', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('OFFICEID')->index();
            $table->bigInteger('SALEID')->index();
            $table->char('VALUETYPE', 1)->default('%');
            $table->decimal('VALUE', 11, 3);
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->string('REFERRALTYPE', 45);
        });

        Schema::connection('rt3')->create('salelead', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->bigInteger('AGENTLISTID')->index();
            $table->char('VALUETYPE', 1)->default('%');
            $table->decimal('VALUE', 11, 3);
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('salehistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->string('COMMENT', 400);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('salefilelibrary', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID');
            $table->bigInteger('FILELIBRARYID')->index();
            $table->unique([ 'SALEID', 'FILELIBRARYID', ]);
        });

        Schema::connection('rt3')->create('saleexternalagency', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->char('VALUETYPE', 1)->default('%');
            $table->string('NAME', 50);
            $table->decimal('VALUE', 11, 3);
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('saleactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->bigInteger('ACTIVITYID')->index();
        });

        Schema::connection('rt3')->create('sale', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->bigInteger('OFFICEID')->index();
            $table->string('DEALNO', 15)->nullable()->index();
            $table->decimal('SALEPRICE', 12, 3);
            $table->date('SALEDATE');
            $table->date('EXPTRANSFERDATE')->nullable();
            $table->string('COMMENTS', 4000)->nullable();
            $table->decimal('GROSSCOMMVALUE', 11, 3)->nullable()->default(0.000);
            $table->char('GROSSCOMM_VALUETYPE', 1)->default('%');
            $table->char('GROSSCOMMVATINCL', 1)->nullable()->default('n');
            $table->char('FRANCHISECOMM_VALUETYPE', 1)->default('%');
            $table->decimal('FRANCHISECOMMVALUE', 11, 3)->nullable()->default(0.000);
            $table->char('FRANCHISEFEERECEIVED', 1)->nullable()->default('n');
            $table->bigInteger('BEETLEREQUIREDID')->default(1)->index();
            $table->bigInteger('ELECTRICALREQUIREDID')->default(1)->index();
            $table->date('BONDEXPIRY')->nullable();
            $table->decimal('BONDAMOUNTREQ', 12, 3)->nullable()->default(0.000);
            $table->string('RT2SALEATTORNEY', 400)->nullable();
            $table->string('RT2BONDATTORNEY', 400)->nullable();
            $table->string('RT2BEETLE', 50)->nullable();
            $table->string('RT2ELECTRICAL', 50)->nullable();
            $table->bigInteger('DEPOSITHELDBYID')->default(1)->index();
            $table->decimal('DEPOSITAMOUNT', 12, 3)->nullable();
            $table->date('DEPOSITDUEDATE')->nullable();
            $table->date('DEPOSITPAIDDATE')->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->bigInteger('SALESTATUSID')->nullable()->default(1);
            $table->string('DEALNAME', 400)->nullable();
            $table->char('ROYALTYFEESPAID', 1)->nullable()->default('N');
            $table->dateTime('ROYALTYFEESPAIDDATE')->nullable();
            $table->bigInteger('ASSISTEDSALEID')->default(1)->index();
            $table->char('REFERRALFEESPAID', 1)->nullable()->default('N');
            $table->dateTime('REFERRALFEESPAIDDATE')->nullable();
            $table->char('RRFINVOICED', 1)->nullable()->default('N');
            $table->dateTime('RRFINVOICEDDATE')->nullable();
        });

        Schema::connection('rt3')->create('replication', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->dateTime('DATE');
        });

        Schema::connection('rt3')->create('rep_sales_detail', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('saleid')->index();
            $table->string('agent', 50)->nullable();
            $table->bigInteger('agent_id')->index();
            $table->bigInteger('agentlistid')->nullable();
            $table->bigInteger('agentsaleslistid')->nullable();
            $table->bigInteger('officeid');
            $table->string('officename', 50)->nullable();
            $table->bigInteger('franchiseid')->nullable();
            $table->bigInteger('officestatusid')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('dealno', 15)->nullable();
            $table->decimal('saleprice', 11, 3)->nullable();
            $table->date('saledate')->nullable()->index();
            $table->date('exptransferdate')->nullable();
            $table->date('statusdate')->nullable();
            $table->bigInteger('statusid')->nullable()->index();
            $table->string('status', 50)->nullable()->index();
            $table->decimal('sale_gross_fees', 11, 3)->nullable();
            $table->decimal('perc_of_sp', 26, 4)->nullable();
            $table->decimal('franchise_fees', 11, 3)->nullable();
            $table->decimal('franchise_fees_perc', 6, 4)->nullable();
            $table->decimal('total_franchise_fees', 11, 3)->nullable();
            $table->decimal('office_gross_fees', 11, 3)->nullable();
            $table->decimal('comm_split_perc', 6, 4)->nullable();
            $table->decimal('branch_comm', 11, 3)->nullable();
            $table->decimal('branch_comm_calc_rand', 11, 3)->nullable();
            $table->decimal('agent_share', 11, 3)->nullable();
            $table->decimal('branch_share', 11, 3)->nullable();
            $table->decimal('agent_share_perc', 26, 4)->nullable();
            $table->decimal('partner_split_perc', 26, 4)->nullable();
            $table->char('deductfranchisefee', 1)->nullable();
            $table->bigInteger('agentlisttypeid')->nullable();
            $table->string('agent_type', 50)->nullable();
            $table->decimal('int_ext_fees', 11, 3)->nullable();
            $table->decimal('net_fees', 11, 3)->nullable();
            $table->decimal('external_fees', 11, 3)->nullable();
            $table->decimal('lead_fees', 11, 3)->nullable();
            $table->decimal('referral_office_fees', 11, 3)->nullable();
            $table->bigInteger('referring_officeid')->nullable();
            $table->decimal('referral_franchise_fees', 11, 3)->nullable();
            $table->char('grossvaluetype', 1)->nullable();
            $table->decimal('grosscommvalue', 11, 3)->nullable();
            $table->decimal('gross_comm_value_calc_perc', 11, 3)->nullable();
            $table->char('agentvaluetype', 1)->nullable();
            $table->decimal('agentcommvalue', 11, 3)->nullable();
            $table->bigInteger('employeestatusid')->nullable();
            $table->char('active', 1)->nullable();
            $table->timestamp('sale_updated')->default('CURRENT_TIMESTAMP');
            $table->char('REFERRALFEESPAID', 1)->nullable()->default('N');
            $table->dateTime('REFERRALFEESPAIDDATE')->nullable();
            $table->bigInteger('sellerlistid')->nullable()->index();
            $table->decimal('achieverunits', 11)->nullable();
            $table->bigInteger('employeeid')->nullable()->index();
            $table->index([ 'agent', 'agent_id', ]);
        });

        Schema::connection('rt3')->create('rep_sales_days_to_market', function (Blueprint $table) {
            $table->bigInteger('OFFICEID')->default(0);
            $table->string('OFFICE', 50);
            $table->decimal('LISTPRICE', 13, 3)->nullable()->default(0.000);
            $table->decimal('SALEPRICE', 11, 3);
            $table->decimal('PERCMATCH', 17)->nullable();
            $table->dateTime('LISTDATE')->default('0000-00-00 00:00:00');
            $table->date('SALEDATE')->nullable();
            $table->integer('DATEDIFERENCE')->nullable();
            $table->string('LISTCODE', 15)->nullable();
            $table->string('DEALNO', 15)->nullable();
            $table->string('FRANCHISECLASSIFICATION', 30);
            $table->string('AGENTNAME', 50)->nullable();
            $table->bigInteger('AGENTID')->nullable();
            $table->bigInteger('SELLERLISTBUSINESSTYPEID')->nullable();
            $table->string('PROPERTYADDRESS', 200)->nullable();
        });

        Schema::connection('rt3')->create('rep_rap_detail', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('employeeid')->index();
            $table->bigInteger('personid')->index();
            $table->string('fullname', 50);
            $table->string('jobtitle', 35)->nullable();
            $table->string('achieverstatus', 25);
            $table->smallInteger('weekofyeargroup');
            $table->smallInteger('year')->index();
            $table->bigInteger('rapcycleid')->index();
            $table->date('cyclestartdate');
            $table->date('cycleenddate');
            $table->smallInteger('weekno')->index();
            $table->date('week_start_date');
            $table->date('week_end_date');
            $table->bigInteger('officeid')->index();
            $table->string('office', 50);
            $table->bigInteger('franchiseid')->index();
            $table->string('franchise', 50);
            $table->string('tc', 100)->nullable();
            $table->string('tc_category', 100)->nullable();
            $table->smallInteger('tc_value')->nullable();
            $table->smallInteger('tc_target')->nullable();
            $table->string('dk', 100)->nullable();
            $table->string('dk_category', 100)->nullable();
            $table->smallInteger('dk_value')->nullable();
            $table->smallInteger('dk_target')->nullable();
            $table->string('ad360', 100)->nullable();
            $table->string('ad360_category', 100)->nullable();
            $table->smallInteger('ad360_value')->nullable();
            $table->smallInteger('ad360_target')->nullable();
            $table->string('nd', 100)->nullable();
            $table->string('nd_category', 100)->nullable();
            $table->smallInteger('nd_value')->nullable();
            $table->smallInteger('nd_target')->nullable();
            $table->string('pid', 100)->nullable();
            $table->string('pid_category', 100)->nullable();
            $table->smallInteger('pid_value')->nullable();
            $table->smallInteger('pid_target')->nullable();
            $table->string('rb', 100)->nullable();
            $table->string('rb_category', 100)->nullable();
            $table->smallInteger('rb_value')->nullable();
            $table->smallInteger('rb_target')->nullable();
            $table->string('events', 100)->nullable();
            $table->string('events_category', 100)->nullable();
            $table->smallInteger('events_value')->nullable();
            $table->smallInteger('events_target')->nullable();
            $table->string('rp', 100)->nullable();
            $table->string('rp_category', 100)->nullable();
            $table->smallInteger('rp_value')->nullable();
            $table->smallInteger('rp_target')->nullable();
            $table->string('smp', 100)->nullable();
            $table->string('smp_category', 100)->nullable();
            $table->smallInteger('smp_value')->nullable();
            $table->smallInteger('smp_target')->nullable();
            $table->string('toc', 100)->nullable();
            $table->string('toc_category', 100)->nullable();
            $table->smallInteger('toc_value')->nullable();
            $table->smallInteger('toc_target')->nullable();
            $table->string('vs', 100)->nullable();
            $table->string('vs_category', 100)->nullable();
            $table->smallInteger('vs_value')->nullable();
            $table->smallInteger('vs_target')->nullable();
            $table->string('sm', 100)->nullable();
            $table->string('sm_category', 100)->nullable();
            $table->smallInteger('sm_value')->nullable();
            $table->smallInteger('sm_target')->nullable();
            $table->string('tl', 100)->nullable();
            $table->string('tl_category', 100)->nullable();
            $table->smallInteger('tl_value')->nullable();
            $table->smallInteger('tl_target')->nullable();
            $table->string('sh', 100)->nullable();
            $table->string('sh_category', 100)->nullable();
            $table->smallInteger('sh_value')->nullable();
            $table->smallInteger('sh_target')->nullable();
            $table->string('bl', 100)->nullable();
            $table->string('bl_category', 100)->nullable();
            $table->smallInteger('bl_value')->nullable();
            $table->smallInteger('bl_target')->nullable();
            $table->string('rr', 100)->nullable();
            $table->string('rr_category', 100)->nullable();
            $table->smallInteger('rr_value')->nullable();
            $table->smallInteger('rr_target')->nullable();
            $table->string('rs', 100)->nullable();
            $table->string('rs_category', 100)->nullable();
            $table->smallInteger('rs_value')->nullable();
            $table->smallInteger('rs_target')->nullable();
            $table->string('vw', 100)->nullable();
            $table->string('vw_category', 100)->nullable();
            $table->smallInteger('vw_value')->nullable();
            $table->smallInteger('vw_target')->nullable();
            $table->string('otp', 100)->nullable();
            $table->string('otp_category', 100)->nullable();
            $table->smallInteger('otp_value')->nullable();
            $table->smallInteger('otp_target')->nullable();
            $table->string('aos', 100)->nullable();
            $table->string('aos_category', 100)->nullable();
            $table->smallInteger('aos_value')->nullable();
            $table->smallInteger('aos_target')->nullable();
            $table->string('aosrf', 100)->nullable();
            $table->string('aosrf_category', 100)->nullable();
            $table->smallInteger('aosrf_value')->nullable();
            $table->smallInteger('aosrf_target')->nullable();
            $table->string('rrf', 100)->nullable();
            $table->string('rrf_category', 100)->nullable();
            $table->smallInteger('rrf_value')->nullable();
            $table->smallInteger('rrf_target')->nullable();
        });

        Schema::connection('rt3')->create('rep_achiever_detail', function (Blueprint $table) {
            $table->string('agentName', 50)->nullable();
            $table->bigInteger('personid')->default(0);
            $table->bigInteger('employeeid')->default(0)->index();
            $table->bigInteger('agentid')->default(0);
            $table->bigInteger('officeid')->default(0);
            $table->string('officeName', 83)->default('');
            $table->string('FFCNO', 10)->nullable();
            $table->string('FFC', 3)->default('');
            $table->string('currStatusDate', 10)->nullable();
            $table->bigInteger('currStatusId')->nullable();
            $table->string('currStatus', 25)->nullable();
            $table->string('calculatedAchieverSatus')->nullable();
            $table->text('comments', 65535)->nullable();
            $table->string('Proficiency', 3)->nullable();
            $table->bigInteger('RAP')->nullable();
            $table->bigInteger('RAPPreviousYear')->nullable();
            $table->bigInteger('totalRAP')->nullable();
            $table->string('NQF4', 3)->nullable();
        });

        Schema::connection('rt3')->create('rep_achiever_detail_2016', function (Blueprint $table) {
            $table->string('agentName', 50)->nullable();
            $table->bigInteger('personid')->default(0);
            $table->bigInteger('employeeid')->default(0)->index();
            $table->bigInteger('agentid')->default(0);
            $table->bigInteger('officeid')->default(0);
            $table->string('officeName', 83)->default('');
            $table->string('FFCNO', 10)->nullable();
            $table->string('FFC', 3)->default('');
            $table->string('currStatusDate', 10)->nullable();
            $table->bigInteger('currStatusId')->nullable();
            $table->string('currStatus', 25)->nullable();
            $table->string('calculatedAchieverSatus')->nullable();
            $table->string('Proficiency', 3)->nullable();
            $table->bigInteger('RAP')->nullable();
            $table->bigInteger('RAPPreviousYear')->nullable();
            $table->bigInteger('totalRAP')->nullable();
            $table->string('NQF4', 3)->nullable();
            $table->text('comments', 65535)->nullable();
        });

        Schema::connection('rt3')->create('rentaltype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('rentalstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('rentalservicesrequired', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RENTALID');
            $table->bigInteger('RENTALSERVICESID')->index();
            $table->unique([ 'RENTALID', 'RENTALSERVICESID', ]);
        });

        Schema::connection('rt3')->create('rentalservices', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('rentalprocessstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RENTALID')->index();
            $table->bigInteger('RENTALPROCESSID')->index();
        });

        Schema::connection('rt3')->create('rentalprocess', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 50)->unique();
        });

        Schema::connection('rt3')->create('rental', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID')->index();
            $table->bigInteger('RENTALSTATUSID')->default(1)->index();
            $table->bigInteger('RENTALTYPEID')->default(1)->index();
            $table->bigInteger('OFFICEID')->index();
            $table->date('AVAILABLEFROM');
            $table->decimal('ANTICIPATEDRENTALINCOME', 11, 3);
            $table->char('FURNISHED', 1)->nullable();
            $table->char('P24APPROVED', 1)->nullable();
            $table->char('MANAGED', 1)->nullable()->default('y');
            $table->bigInteger('LISTINGWEBID')->nullable()->index();
            $table->bigInteger('RAWSONCOZAID')->nullable()->index();
        });

        Schema::connection('rt3')->create('referencetype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('rawsonsuburbs', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAWSONAREADEFINITIONID');
            $table->bigInteger('SUBURBID')->index();
            $table->unique([ 'RAWSONAREADEFINITIONID', 'SUBURBID', ]);
        });

        Schema::connection('rt3')->create('rawsonmutualexclusiveoffices', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('OFFICEID');
            $table->bigInteger('EXCLUDEDOFFICEID')->index();
            $table->unique([ 'OFFICEID', 'EXCLUDEDOFFICEID', ]);
        });

        Schema::connection('rt3')->create('rawsoncoza', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('APPROVED', 1)->nullable()->default('n');
            $table->char('SOLDSIGN', 1)->nullable()->default('n');
            $table->char('OVERRIDECAPS', 1)->nullable()->default('n');
            $table->char('EXPORTEDTOWEB', 1)->nullable()->default('n');
            $table->string('VIRTUALTOURURL', 200)->nullable();
            $table->time('AUCTIONTIME')->nullable();
            $table->string('AUCTIONLOCATION', 100)->nullable();
            $table->date('AUCTIONDATE')->nullable();
            $table->char('DISPLAYMANDATE', 1)->nullable()->default('n');
            $table->char('PRIMEPROPERTY', 1)->nullable()->default('n');
            $table->char('BANKMANDATE', 1)->nullable()->default('n');
            $table->char('CHAIRMANSCHOICE', 1)->nullable();
            $table->char('ACTION', 1)->nullable()->default('c');
            $table->date('SOLDSIGNDATE')->nullable();
        });

        Schema::connection('rt3')->create('rawsonareadefinition', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAWSONAREAID');
            $table->bigInteger('OFFICEID')->index();
            $table->unique([ 'RAWSONAREAID', 'OFFICEID', ]);
        });

        Schema::connection('rt3')->create('rawsonarea', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('ratesperiod', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('rapcyclemanagement', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->date('EFFECTIVEDATE');
            $table->integer('CYCLE');
            $table->char('ACTIVE', 1)->default('y');
        });

        Schema::connection('rt3')->create('rapcycle', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->date('EFFECTIVESTARTDATE');
            $table->date('EFFECTIVEENDDATE');
            $table->smallInteger('WEEKOFYEARGROUP');
            $table->smallInteger('YEAR');
            $table->smallInteger('CYCLE')->unique();
            $table->date('W1STARTDATE');
            $table->date('W1ENDDATE');
            $table->date('W2STARTDATE');
            $table->date('W2ENDDATE');
            $table->date('W3STARTDATE');
            $table->date('W3ENDDATE');
            $table->date('W4STARTDATE');
            $table->date('W4ENDDATE');
        });

        Schema::connection('rt3')->create('rapcategory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAPCYCLEMANAGEMENTID');
            $table->string('ITEM', 100);
            $table->smallInteger('SORTORDER')->default(1);
            $table->char('ACTIVE', 1)->default('y');
            $table->char('READONLY', 1)->default('n');
            $table->smallInteger('MINIMUMCATEGORYPOINTS')->default(100);
            $table->unique([ 'RAPCYCLEMANAGEMENTID', 'ITEM',]);
        });

        Schema::connection('rt3')->create('rapactivityplansellerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAPACTIVITYPLANID')->index();
            $table->bigInteger('SELLERLISTID')->index();
        });

        Schema::connection('rt3')->create('rapactivityplan', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAPACTIVITYID')->index();
            $table->bigInteger('EMPLOYEEID')->index();
            $table->bigInteger('RAPCYCLEID')->index();
            $table->smallInteger('POINTS')->default(1);
            $table->decimal('PPA', 10)->default(1.00);
            $table->smallInteger('PPC')->default(1);
            $table->char('ACTIVE', 1)->default('y');
            $table->smallInteger('WEEKOFYEARGROUP');
            $table->smallInteger('W1')->default(0);
            $table->smallInteger('W2')->default(0);
            $table->smallInteger('W3')->default(0);
            $table->smallInteger('W4')->default(0);
            $table->char('DISPLAYWEEKLY', 1)->default('y');
            $table->char('ISCOMPUTED', 1)->default('n');
            $table->string('COMPUTEDSQL_TOTAL', 100)->nullable();
            $table->smallInteger('YEAR')->default(0);
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('rapactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAPCATEGORYID')->default(1)->index();
            $table->string('ITEM', 100);
            $table->smallInteger('SORTORDER')->default(1);
            $table->char('ACTIVE', 1)->default('y');
            $table->decimal('WEIGHT', 10)->default(1.00);
            $table->smallInteger('RECOMMENDEDPOINTS')->default(1);
            $table->date('EFFECTIVEDATESTART')->nullable();
            $table->date('EFFECTIVEDATEEND')->nullable();
            $table->char('DISPLAYWEEKLY', 1)->default('y');
            $table->char('ISCOMPUTED', 1)->default('n');
            $table->string('COMPUTEDSQL_TOTAL', 100)->nullable();
            $table->unique([ 'ITEM', 'RAPCATEGORYID', ]);
        });

        Schema::connection('rt3')->create('province', function (Blueprint $table) {
            $table->bigInteger('ID')->primary();
            $table->string('ITEM', 25)->unique();
            $table->bigInteger('COUNTRYID')->nullable()->index();
        });

        Schema::connection('rt3')->create('propertytypebusinesstype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('BUSINESSTYPEID');
            $table->bigInteger('PROPERTYTYPEID')->index();
            $table->unique([ 'BUSINESSTYPEID', 'PROPERTYTYPEID', ]);
        });

        Schema::connection('rt3')->create('propertytype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 40)->unique();
            $table->smallInteger('SORTORDER')->default(0);
            $table->char('RESIDENTIAL', 1)->default('n');
            $table->char('COMMERCIAL', 1)->default('n');
        });

        Schema::connection('rt3')->create('propertytitletype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('propertymeasurements', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 5)->unique();
        });

        Schema::connection('rt3')->create('propertyimageref', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID')->index();
            $table->integer('SORTORDER')->nullable()->default(0);
            $table->string('CAPTION', 100)->nullable();
            $table->char('DISPLAY', 1)->default('y');
            $table->bigInteger('SELLERLISTID')->nullable();
            $table->string('IMAGELARGE', 200)->nullable();
            $table->string('IMAGESMALL', 200)->nullable();
            $table->string('IMAGETHUMBNAIL', 200)->nullable();
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('propertyhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID')->index();
            $table->string('COMMENT', 400);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('propertyfeaturesdescription', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYFEATURESCATEGORYID')->index();
            $table->string('ITEM', 25)->index();
            $table->unique([ 'PROPERTYFEATURESCATEGORYID', 'ITEM', ]);
        });

        Schema::connection('rt3')->create('propertyfeaturescategory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
            $table->char('CHECKBOX', 1)->default('y');
        });

        Schema::connection('rt3')->create('propertyfeatures', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYID');
            $table->bigInteger('PROPERTYFEATURESDESCRIPTIONID')->index();
            $table->unique([ 'PROPERTYID', 'PROPERTYFEATURESDESCRIPTIONID', ]);
        });

        Schema::connection('rt3')->create('propertyactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACTIVITYID')->index();
            $table->bigInteger('PROPERTYID')->index();
        });

        Schema::connection('rt3')->create('property', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYTYPEID')->index();
            $table->bigInteger('MEASUREMENTSID')->index();
            $table->bigInteger('RATESPERIODID')->default(1)->index();
            $table->string('ERFNO', 50)->nullable();
            $table->string('SECTIONALTITLENO', 20)->nullable();
            $table->decimal('ERFSIZE', 11, 3)->nullable();
            $table->decimal('BUILDINGSIZE', 11, 3)->nullable();
            $table->decimal('RATESAMT', 11, 3)->nullable();
            $table->decimal('SECTIONALTITLELEVY', 11, 3)->nullable();
            $table->decimal('HOMEOWNERLEVY', 11, 3)->nullable();
            $table->smallInteger('NUMBEDROOMS')->nullable();
            $table->decimal('NUMBATHROOMS', 11, 3)->nullable();
            $table->smallInteger('NUMRECEPTIONROOMS')->nullable();
            $table->smallInteger('NUMSTUDIES')->nullable();
            $table->smallInteger('NUMFAMILYROOMS')->nullable();
            $table->smallInteger('NUMSTOREROOMS')->nullable();
            $table->smallInteger('NUMFIREPLACES')->nullable();
            $table->smallInteger('NUMGARAGES')->nullable();
            $table->smallInteger('NUMCARPORTS')->nullable();
            $table->smallInteger('NUMPARKING')->nullable();
            $table->smallInteger('NUMFLATLETS')->nullable();
            $table->bigInteger('PROPERTYTITLETYPEID')->index();
            $table->bigInteger('PHYSICALADDRESSID');
            $table->string('UNITNAME', 100)->nullable();
            $table->string('UNITNUMBER', 10)->nullable();
            $table->string('STREETNUMBER', 10)->nullable();
            $table->string('PHYSICALADDRESS', 100)->index();
            $table->string('propertyaddress', 200)->nullable()->index();
            $table->string('MANAGINGAGENT', 50)->nullable();
            $table->string('ADDITIONALFEATURES', 200)->nullable();
            $table->string('COMMENTS', 200)->nullable();
            $table->decimal('GEOLATITUDE', 12, 8)->nullable();
            $table->decimal('GEOLONGITUDE', 12, 8)->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->bigInteger('LIGHTSTONEID')->nullable();
            $table->smallInteger('NUMTVROOM')->nullable();
            $table->smallInteger('NUMLOUNGE')->nullable();
            $table->smallInteger('NUMDININGROOM')->nullable();
            $table->char('GEOLOCATIONOPTION', 1)->nullable()->default('a');
            $table->string('NAME', 100)->nullable();
            $table->bigInteger('AGENTLISTID')->nullable()->index();
            $table->bigInteger('OFFICEID')->nullable()->index();
            $table->unique([
                'PHYSICALADDRESSID',
                'PHYSICALADDRESS',
                'UNITNAME',
                'UNITNUMBER',
                'STREETNUMBER',
            ]);
        });

        Schema::connection('rt3')->create('postalcode', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('ITEM', 4)->unique();
        });

        Schema::connection('rt3')->create('pjunction', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('APPROVED', 1)->nullable()->default('n');
        });

        Schema::connection('rt3')->create('pgenie', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('APPROVED', 1)->nullable()->default('n');
            $table->string('RESULTMSG', 500)->nullable();
            $table->string('PGENIEREF', 45)->nullable();
            $table->date('LISTDATE')->nullable();
            $table->date('EXPIRYDATE')->nullable();
            $table->char('ACTION', 1)->nullable()->default('c');
            $table->char('DISPLAYADDRESS', 1)->nullable()->default('n');
        });

        Schema::connection('rt3')->create('personsource', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID')->index();
            $table->bigInteger('ADVERTISINGSOURCEID')->index();
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('personsellerlistreferral', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTREFERRALID')->index();
            $table->bigInteger('PERSONID')->index();
        });

        Schema::connection('rt3')->create('personsellerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('SELLERLISTID')->index();
            $table->unique([ 'PERSONID', 'SELLERLISTID', ]);
        });

        Schema::connection('rt3')->create('personsalestype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('personsales', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('SALESID')->index();
            $table->bigInteger('PERSONSALESTYPEID')->default(1)->index();
            $table->bigInteger('CLIENTTYPEID')->default(1)->index();
            $table->char('OCCUPANT', 1)->nullable()->default('y');
            $table->date('OCCUPANTDATE')->nullable();
            $table->bigInteger('FUTUREADDRESSID')->nullable()->index();
            $table->string('FUTUREADDRESS', 100)->nullable();
            $table->unique([ 'PERSONID', 'SALESID', ]);
        });

        Schema::connection('rt3')->create('personrental', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RENTALID');
            $table->bigInteger('PERSONID')->index();
            $table->unique([ 'RENTALID', 'PERSONID', ]);
        });

        Schema::connection('rt3')->create('personhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
            $table->bigInteger('PERSONID')->index();
            $table->string('COMMENT', 200);
        });

        Schema::connection('rt3')->create('personbuyerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID');
            $table->bigInteger('BUYERLISTID')->index();
            $table->unique([ 'PERSONID', 'BUYERLISTID', ]);
        });

        Schema::connection('rt3')->create('personagentlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID')->index();
            $table->bigInteger('PERSONID')->index();
            $table->char('ACTIVE', 1)->default('y');
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('person', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PHYSICALADDRESSID')->nullable()->default(1)->index();
            $table->bigInteger('TITLEID')->nullable()->default(1)->index();
            $table->bigInteger('JOBTITLEID')->nullable()->default(1)->index();
            $table->bigInteger('LANGUAGEPREFERENCEID')->nullable()->default(1)->index();
            $table->string('FIRSTNAME', 25)->index();
            $table->string('CELLPHONE', 20);
            $table->string('LASTNAME', 25)->nullable()->index();
            $table->string('KNOWNAS', 25)->nullable();
            $table->string('EMAIL', 60)->nullable();
            $table->string('FAX', 20)->nullable();
            $table->string('TELHOME', 20)->nullable();
            $table->string('TELOFFICE', 20)->nullable();
            $table->date('DOB')->nullable();
            $table->date('WEDDINGANIVERSARY')->nullable();
            $table->string('SPOUSENAME', 35)->nullable();
            $table->char('IDNUMBER', 13)->nullable()->index();
            $table->string('PASSPORTNUMBER', 20)->nullable();
            $table->string('PHYSICALADDRESS', 100)->nullable();
            $table->string('POSTALADDRESS', 500)->nullable();
            $table->string('SHORTNAME', 25)->nullable();
            $table->string('ALTERNATECONTACTDETAILS', 200)->nullable();
            $table->string('TAXNUMBER', 15)->nullable();
            $table->string('COMMENTS', 200)->nullable();
            $table->bigInteger('MARITALSTATUSID')->nullable()->default(1)->index();
            $table->string('FULLNAME', 50)->nullable()->index();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->string('FULLNAMESANITIZED', 50)->nullable()->index();
            $table->string('CELLPHONESANITIZED', 20)->nullable()->index();
            $table->string('PHOTOURLSMALL', 200)->nullable();
            $table->string('PHOTOURLLARGE', 200)->nullable();
            $table->char('UUID', 36)->nullable();
            $table->char('SUBSCRIBED', 1)->nullable()->default('y');
        });

        Schema::connection('rt3')->create('p24suburbs', function (Blueprint $table) {
            $table->string('countryName', 250);
            $table->bigInteger('countryID');
            $table->string('provinceName', 100);
            $table->bigInteger('provinceID');
            $table->string('cityName', 250);
            $table->bigInteger('cityID');
            $table->string('suburbName', 250);
            $table->bigInteger('suburbID');
            $table->integer('status');
        });

        Schema::connection('rt3')->create('p24stats_with_dupes', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->smallInteger('ALERTCOUNT')->default(0);
            $table->smallInteger('EMAILLEADS')->default(0);
            $table->smallInteger('SMSLEADS')->default(0);
            $table->smallInteger('TELLEADS')->default(0);
            $table->smallInteger('VIEWCOUNTS')->default(0);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('p24stats', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->smallInteger('ALERTCOUNT')->default(0);
            $table->smallInteger('EMAILLEADS')->default(0);
            $table->smallInteger('SMSLEADS')->default(0);
            $table->smallInteger('TELLEADS')->default(0);
            $table->smallInteger('VIEWCOUNTS')->default(0);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('p24stakeholder', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID')->index();
            $table->bigInteger('FRANCHISEID')->index();
        });

        Schema::connection('rt3')->create('p24', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('LISTINGNUMBER', 10)->nullable();
            $table->date('LISTDATE')->nullable();
            $table->date('EXPIRYDATE')->nullable();
            $table->char('APPROVED', 1)->nullable()->default('n');
            $table->char('ACTION', 1)->nullable()->default('c');
            $table->string('ResultMsg', 500)->nullable();
            $table->char('DISPLAYADDRESS', 1)->nullable()->default('n');
        });

        Schema::connection('rt3')->create('othersuspcondition', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->string('DESCRIPTION', 200);
            $table->date('EXPIRYDATE');
            $table->date('DATEMET')->nullable();
        });
        
        Schema::connection('rt3')->create('officestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('office', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('OFFICESTATUSID')->default(1)->index();
            $table->bigInteger('PHYSICALADDRESSID')->default(1)->index();
            $table->bigInteger('FRANCHISEID')->index();
            $table->string('NAME', 50)->unique();
            $table->char('SPEEDDIAL', 5)->nullable();
            $table->string('TEL', 20);
            $table->string('TELEPHONESANITIZED', 15)->nullable();
            $table->string('FAX', 20)->nullable();
            $table->string('EMAIL', 60)->nullable();
            $table->string('PHYSICALADDRESS', 100)->nullable();
            $table->string('POSTALADDRESS', 500)->nullable();
            $table->string('UNITNAME', 50)->nullable();
            $table->string('STREETNUMBER', 25)->nullable();
            $table->string('STREETNAME', 50);
            $table->decimal('GEOLATITUDE', 12, 8)->nullable();
            $table->decimal('GEOLONGITUDE', 12, 8)->nullable();
            $table->string('COMMENTS', 1000)->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->string('TWITTERACCOUNT', 100)->nullable();
            $table->string('GOOGLEACCOUNT', 100)->nullable();
            $table->string('FACEBOOKACCOUNT', 100)->nullable();
        });

        Schema::connection('rt3')->create('municipalareadefinition', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('P24ID')->nullable();
            $table->bigInteger('PROVINCEID');
            $table->bigInteger('MUNICIPALAREAID')->index();
            $table->bigInteger('SUBURBID')->index();
            $table->bigInteger('POSTALCODEID')->index();
            $table->unique([ 'PROVINCEID','MUNICIPALAREAID','SUBURBID','POSTALCODEID', ]);
        });

        Schema::connection('rt3')->create('municipalarea', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 40)->unique();
        });

        Schema::connection('rt3')->create('maritalstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('mandatetype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('listingweb', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('WEBTAGLINE', 200)->nullable();
            $table->string('WEBDESCRIPTION', 4000)->nullable();
            $table->string('DISPLAYBROCHUREDESCRIPTION', 1000)->nullable();
            $table->string('SHOWHOUSEBROCHUREDESCRIPTION', 250)->nullable();
        });

        Schema::connection('rt3')->create('listingaccess', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('leasestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 10)->unique();
        });

        Schema::connection('rt3')->create('leaseprocessstatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('LEASEPROCESSID')->index();
            $table->bigInteger('LEASEID')->index();
        });

        Schema::connection('rt3')->create('leaseprocess', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 100)->unique();
        });

        Schema::connection('rt3')->create('lease', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('TENANTID')->index();
            $table->bigInteger('RENTALID')->index();
            $table->bigInteger('LEASESTATUSID')->index();
            $table->string('LEASENO', 10)->nullable();
            $table->char('CANRENEW', 1)->nullable()->default('y');
            $table->date('EXPIRY')->nullable();
            $table->date('START');
            $table->date('END')->nullable();
            $table->decimal('LEASEAMOUT', 11, 3);
            $table->decimal('DEPOSIT', 11, 3)->nullable();
            $table->string('ADDITIONALTASKS', 200)->nullable();
            $table->decimal('MANAGEMENTFEE', 11, 3)->nullable();
            $table->char('VATINCLUDED', 1)->default('n');
            $table->decimal('LEASEFEE', 11, 3)->nullable();
            $table->smallInteger('STAMPFEEPERIOD')->nullable();
        });

        Schema::connection('rt3')->create('languagepreference', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 10)->unique();
        });

        Schema::connection('rt3')->create('jobtitle', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 35)->unique();
        });

        Schema::connection('rt3')->create('iol', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('APPROVED', 1)->nullable()->default('n');
            $table->date('LISTDATE')->nullable();
        });

        Schema::connection('rt3')->create('franchisestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 15)->unique();
        });

        Schema::connection('rt3')->create('franchisehistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('FRANCHISEID')->index();
            $table->date('COMMENCEMENTDATE');
            $table->date('OPERATIONALDATE')->nullable();
            $table->date('CLOSUREDATE')->nullable();
        });

        Schema::connection('rt3')->create('franchisefilelibrary', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('FRANCHISEID');
            $table->bigInteger('FILELIBRARYID')->index();
            $table->unique([ 'FRANCHISEID', 'FILELIBRARYID', ]);
        });

        Schema::connection('rt3')->create('franchiseconsultants', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('FRANCHISEID');
            $table->bigInteger('EMPLOYEEID')->index();
            $table->unique([ 'FRANCHISEID', 'EMPLOYEEID', ]);
        });

        Schema::connection('rt3')->create('franchiseclassification', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('franchisebusinesstype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('BUSINESSTYPEID');
            $table->bigInteger('FRANCHISEID')->index();
            $table->unique([ 'BUSINESSTYPEID', 'FRANCHISEID', ]);
        });

        Schema::connection('rt3')->create('franchiseaward', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('FRANCHISEID')->index();
            $table->bigInteger('AWARDDESCRIPTIONID')->default(1)->index();
            $table->date('DATE');
        });

        Schema::connection('rt3')->create('franchise', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('STAKEHOLDERID')->index();
            $table->bigInteger('FRANCHISESTATUSID')->index();
            $table->bigInteger('FRANCHISECLASSIFICATIONID')->index();
            $table->string('NAME', 50)->unique();
            $table->string('WEBPORTALNAME', 50)->nullable();
            $table->string('BUSINESSNAMECOR', 100)->nullable();
            $table->decimal('SALESTARGET', 11, 3)->nullable()->default(0.000);
            $table->decimal('PERCENTGROSS', 5)->nullable()->default(0.00);
            $table->char('FRANCHISEFEEPAYABLE', 1)->nullable()->default('y');
            $table->char('P24FEED', 1)->nullable()->default('n');
            $table->char('P24OFFICEID', 6)->nullable();
            $table->char('FNBQSID', 36)->nullable();
            $table->char('PGENIEOFFICEID', 6)->nullable();
            $table->char('PGENIEREG', 1)->nullable()->default('n');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->char('CCMANAGERONLEADS', 1)->nullable()->default('n');
            $table->bigInteger('AGENTLISTID')->nullable()->index();
        });

        Schema::connection('rt3')->create('fnbstats', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SELLERLISTID')->index();
            $table->char('REF', 10);
            $table->string('FULLNAME', 50)->nullable();
            $table->date('DATE')->nullable();
            $table->string('LEADTYPE', 50)->nullable();
            $table->string('CELLPHONE', 20)->nullable();
            $table->string('TEL', 20)->nullable();
            $table->string('FROMEMAIL', 60)->nullable();
            $table->string('TOEMAIL', 60)->nullable();
            $table->string('COMMENT', 1000)->nullable();
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('fnb', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->char('PRIVATEPROPERTYAPPROVED', 1)->nullable()->default('n');
            $table->string('RESULTMSG', 500)->nullable();
            $table->string('STATUS', 500)->nullable();
            $table->char('REF', 10)->nullable();
            $table->date('LISTDATE')->nullable();
            $table->date('EXPIRY')->nullable();
            $table->char('PRIVATEPROPERTYACTION', 1)->nullable()->default('c');
            $table->char('DISPLAYADDRESS', 1)->nullable()->default('n');
        });

        Schema::connection('rt3')->create('financialinstitution', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('filelibrary', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('URL', 300);
            $table->string('NAME', 100);
            $table->string('DESCRIPTION', 200)->nullable();
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('ficastatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('FICAID');
            $table->bigInteger('PERSONID')->index();
            $table->unique([ 'FICAID','PERSONID', ]);
        });

        Schema::connection('rt3')->create('fica', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('ffchistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('EMPLOYEEID')->index();
            $table->string('FFCNO', 10);
            $table->date('DATE');
            $table->string('COMPANYNAME', 100)->nullable();
        });

        Schema::connection('rt3')->create('employmenthistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->date('APPOINTEDDATE');
            $table->date('RESIGNATIONDATE')->nullable();
            $table->unique([ 'AGENTLISTID', 'APPOINTEDDATE', ]);
        });

        Schema::connection('rt3')->create('employeestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('employeefilelibrary', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('EMPLOYEEID');
            $table->bigInteger('FILELIBRARYID')->index();
            $table->unique([ 'EMPLOYEEID','FILELIBRARYID', ]);
        });

        Schema::connection('rt3')->create('employeeeeclassification', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 45);
        });

        Schema::connection('rt3')->create('employeeaward', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('EMPLOYEEID')->index();
            $table->date('DATE');
            $table->bigInteger('AWARDDESCRIPTIONID')->default(1)->index();
        });

        Schema::connection('rt3')->create('employee', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PERSONID')->unique();
            $table->bigInteger('EMPLOYEESTATUSID')->default(1)->index();
            $table->decimal('TAXRATE', 5)->default(0.00);
            $table->string('FFCNO', 11)->nullable();
            $table->string('FFCSTATUS', 45)->nullable();
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->string('BVRNO', 45)->nullable();
            $table->dateTime('BVRDATE')->nullable();
            $table->bigInteger('EMPLOYEEEECLASSIFICATIONID')->nullable()->index();
            $table->string('PRIVYSEAL', 100)->nullable();
        });

        Schema::connection('rt3')->create('depositheldby', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('currency', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 3)->unique();
        });

        Schema::connection('rt3')->create('creditcheckoptions', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('coursestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('coursehistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('COURSEDESCRIPTIONID');
            $table->bigInteger('EMPLOYEEID')->index();
            $table->date('STARTDATE')->index();
            $table->bigInteger('COURSESTATUSID')->index();
            $table->string('COMMENTS', 300)->nullable();
            $table->unique([ 'COURSEDESCRIPTIONID', 'EMPLOYEEID', 'STARTDATE', ]);
            $table->unique([ 'COURSEDESCRIPTIONID', 'EMPLOYEEID', 'COURSESTATUSID', 'STARTDATE', ]);
        });

        Schema::connection('rt3')->create('coursecategory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('course', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('NAME', 200)->unique();
            $table->smallInteger('DURATIONNUM');
            $table->char('DURATIONINTERVAL', 1);
            $table->bigInteger('COURSECATEGORYID')->index();
            $table->char('MANDATORY', 1)->default('y');
        });

        Schema::connection('rt3')->create('country', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 45)->unique();
        });

        Schema::connection('rt3')->create('clienttype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('buyerpropertytype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('PROPERTYTYPEID');
            $table->bigInteger('BUYERLISTID')->index();
            $table->unique([ 'PROPERTYTYPEID', 'BUYERLISTID', ]);
        });

        Schema::connection('rt3')->create('buyerliststatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('buyerlistofficestatus', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('BUYERLISTID')->index();
            $table->bigInteger('BUYERLISTSTATUSID')->index();
            $table->bigInteger('OFFICEID')->index();
            $table->timestamp('STATUSDATE')->nullable()->default('CURRENT_TIMESTAMP');
        });

        Schema::connection('rt3')->create('buyerlistmad', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('MADID')->index();
            $table->bigInteger('BUYERLISTID')->index();
        });

        Schema::connection('rt3')->create('buyerlistclassification', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('BUYERCLASSIFICATIONID');
            $table->bigInteger('BUYERLISTID')->index();
            $table->unique([ 'BUYERCLASSIFICATIONID', 'BUYERLISTID', ]);
        });

        Schema::connection('rt3')->create('buyerlistactivity', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('ACTIVITYID')->index();
            $table->bigInteger('BUYERLISTID')->index();
        });

        Schema::connection('rt3')->create('buyerlist', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('BUYERLISTSTATUSID')->default(7)->index();
            $table->bigInteger('ADVERTISINGSOURCEID')->nullable()->index();
            $table->bigInteger('OFFICEID')->index();
            $table->decimal('MINPRICE', 11, 3)->default(0.000);
            $table->decimal('MAXPRICE', 11, 3)->default(0.000);
            $table->smallInteger('NUMBEDROOMS')->default(0);
            $table->smallInteger('NUMBATHROOMS')->default(0);
            $table->smallInteger('NUMGARAGES')->default(0);
            $table->smallInteger('NUMCARPORTS')->default(0);
            $table->string('REQUIREMENTS', 1000)->nullable();
            $table->dateTime('INTRODUCTIONDATE')->nullable()->index();
            $table->string('BUYERSOURCEOTHER', 200)->nullable();
            $table->date('EXPIRYDATE')->nullable();
            $table->string('COMMENTS', 4000)->nullable();
            $table->string('REFERENCE', 20)->nullable();
            $table->char('REFMETHODCREATED', 1)->default('n');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
        });

        Schema::connection('rt3')->create('buyerhistory', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->timestamp('CREATED')->default('CURRENT_TIMESTAMP');
            $table->bigInteger('BUYERLISTID')->index();
            $table->string('COMMENT', 200);
        });

        Schema::connection('rt3')->create('buyerclassification', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 20)->unique();
        });

        Schema::connection('rt3')->create('buyerareas', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('RAWSONAREADEFINITIONID');
            $table->bigInteger('BUYERLISTID')->index();
            $table->char('OWNEROFFICE', 1)->default('n');
            $table->date('EXPIRYDATE')->nullable();
            $table->char('DIRECT', 1)->default('n');
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->unique([ 'RAWSONAREADEFINITIONID', 'BUYERLISTID', ]);
        });

        Schema::connection('rt3')->create('buyer_referals_summary', function (Blueprint $table) {
            $table->bigInteger('buyerlistid')->default(0);
            $table->bigInteger('personid')->default(0);
            $table->dateTime('created')->default('0000-00-00 00:00:00');
            $table->date('expirydate')->nullable();
            $table->string('reference', 20)->nullable();
            $table->string('fromofficeid', 100)->nullable()->index();
            $table->string('fromoffice', 50);
            $table->string('fromofficetel', 20);
            $table->string('fromofficelabel', 77)->default('');
            $table->string('fromagentid', 100)->nullable()->index();
            $table->text('fromagent', 16777215)->nullable();
            $table->string('toagentid', 100)->nullable()->index();
            $table->string('toofficeid', 100)->nullable()->index();
            $table->text('toagent', 16777215)->nullable();
            $table->bigInteger('statusid')->default(0);
            $table->string('status', 30);
            $table->string('buyername', 50)->nullable();
            $table->string('cellphone', 20);
            $table->string('email', 60)->nullable();
            $table->decimal('maxprice', 11, 3)->default(0.000);
            $table->text('rawsonarea', 16777215)->nullable();
            $table->bigInteger('activitycount')->nullable();
            $table->dateTime('summary_created')->default('0000-00-00 00:00:00');
            $table->date('referralexpirydate')->nullable();
            $table->date('referralcreated')->nullable();
            $table->char('direct', 1)->default('n');
        });
        
        Schema::connection('rt3')->create('businesstype', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('bondoriginator', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 40)->unique();
        });

        Schema::connection('rt3')->create('bondinstitution', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 25)->unique();
        });

        Schema::connection('rt3')->create('bondapplication', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('SALEID')->index();
            $table->date('APPLICATIONDATE');
            $table->date('APPROVALDATE')->nullable();
            $table->bigInteger('ORIGINATORID')->index();
            $table->bigInteger('FINANCIALINSTITUTIONID')->nullable()->default(1)->index();
            $table->bigInteger('RFSCONSULTANTID')->nullable()->default(1)->index();
            $table->decimal('AMOUNT', 12, 3)->default(0.000);
            $table->char('APPROVED', 1)->default('n');
            $table->char('SELECTED', 1)->default('n');
            $table->char('GROSSCOMM_VALUETYPE', 1)->nullable()->default('%');
            $table->decimal('GROSSCOMMVALUE', 11, 3)->nullable()->default(0.000);
            $table->char('GROSSCOMMVATINCL', 1)->nullable()->default('n');
            $table->char('FRANCHISECOMM_VALUETYPE', 1)->nullable()->default('%');
            $table->decimal('FRANCHISECOMMVALUE', 11, 3)->nullable()->default(0.000);
            $table->timestamp('UPDATED')->default('CURRENT_TIMESTAMP');
            $table->dateTime('CREATED')->default('0000-00-00 00:00:00');
            $table->decimal('BONDCOMMINCVAT', 12, 3)->nullable()->default(0.000);
            $table->decimal('BONDCOMMEXVAT', 12, 3)->nullable()->default(0.000);
            $table->decimal('BONDCOMMAFTERFF', 12, 3)->nullable()->default(0.000);
            $table->decimal('BANKCOST', 12, 3)->nullable()->default(0.000);
            $table->decimal('BONDCOMMFORDISTRIBUTION', 12, 3)->nullable()->default(0.000);
        });

        Schema::connection('rt3')->create('bondagent', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->bigInteger('AGENTLISTID');
            $table->bigInteger('BONDAPPLICATIONID')->index();
            $table->char('GROSSCOMM_VALUETYPE', 1)->default('%');
            $table->decimal('GROSSCOMMVALUE', 11, 3);
            $table->char('SPLIT_VALUETYPE', 1)->default('%');
            $table->decimal('SPLITVALUE', 11, 3);
            $table->char('DEDUCTFRANCHISEFEE', 1)->default('n');
            $table->unique([ 'AGENTLISTID', 'BONDAPPLICATIONID', ]);
        });

        Schema::connection('rt3')->create('bank', function (Blueprint $table) {
            $table->bigInteger('ID', true);
            $table->string('ITEM', 30)->unique();
        });

        Schema::connection('rt3')->create('webservice_mappings', function (Blueprint $table) {
            $table->bigInteger('ID')->primary();
            $table->string('WEBSERVICE', 45);
            $table->string('PROPERTY', 45);
            $table->string('RT3VALUE', 45);
            $table->string('WEBSERVICEVALUE', 45);
            $table->bigInteger('WEBSERVICEID')->nullable();
        });
    }

    public function down()
    {
        Schema::connection('rt3')->drop('achieverhistory');
        Schema::connection('rt3')->drop('achieverstatus');
        Schema::connection('rt3')->drop('activity');
        Schema::connection('rt3')->drop('activityaccesstype');
        Schema::connection('rt3')->drop('activityagentlist');
        Schema::connection('rt3')->drop('activitycontext');
        Schema::connection('rt3')->drop('activityhistory');
        Schema::connection('rt3')->drop('activitypersonlist');
        Schema::connection('rt3')->drop('activitystatus');
        Schema::connection('rt3')->drop('activitytype');
        Schema::connection('rt3')->drop('activityvisitorlist');
        Schema::connection('rt3')->drop('advertising');
        Schema::connection('rt3')->drop('advertisingagentlist');
        Schema::connection('rt3')->drop('advertisingsource');
        Schema::connection('rt3')->drop('advertisingsourceitem');
        Schema::connection('rt3')->drop('advertisingsourcetype');
        Schema::connection('rt3')->drop('agentbuyerlist');
        Schema::connection('rt3')->drop('agentlist');
        Schema::connection('rt3')->drop('agentlisttype');
        Schema::connection('rt3')->drop('agentrental');
        Schema::connection('rt3')->drop('agentsalelist');
        Schema::connection('rt3')->drop('agentsellerlist');
        Schema::connection('rt3')->drop('agentsellerlistreferral');
        Schema::connection('rt3')->drop('assistedsale');
        Schema::connection('rt3')->drop('awarddescription');
        Schema::connection('rt3')->drop('bank');
        Schema::connection('rt3')->drop('bondagent');
        Schema::connection('rt3')->drop('bondapplication');
        Schema::connection('rt3')->drop('bondinstitution');
        Schema::connection('rt3')->drop('bondoriginator');
        Schema::connection('rt3')->drop('businesstype');
        Schema::connection('rt3')->drop('buyer_referals_summary');
        Schema::connection('rt3')->drop('buyerareas');
        Schema::connection('rt3')->drop('buyerclassification');
        Schema::connection('rt3')->drop('buyerhistory');
        Schema::connection('rt3')->drop('buyerlist');
        Schema::connection('rt3')->drop('buyerlistactivity');
        Schema::connection('rt3')->drop('buyerlistclassification');
        Schema::connection('rt3')->drop('buyerlistmad');
        Schema::connection('rt3')->drop('buyerlistofficestatus');
        Schema::connection('rt3')->drop('buyerliststatus');
        Schema::connection('rt3')->drop('buyerpropertytype');
        Schema::connection('rt3')->drop('clienttype');
        Schema::connection('rt3')->drop('country');
        Schema::connection('rt3')->drop('course');
        Schema::connection('rt3')->drop('coursecategory');
        Schema::connection('rt3')->drop('coursehistory');
        Schema::connection('rt3')->drop('coursestatus');
        Schema::connection('rt3')->drop('creditcheckoptions');
        Schema::connection('rt3')->drop('currency');
        Schema::connection('rt3')->drop('depositheldby');
        Schema::connection('rt3')->drop('employee');
        Schema::connection('rt3')->drop('employeeaward');
        Schema::connection('rt3')->drop('employeeeeclassification');
        Schema::connection('rt3')->drop('employeefilelibrary');
        Schema::connection('rt3')->drop('employeestatus');
        Schema::connection('rt3')->drop('employmenthistory');
        Schema::connection('rt3')->drop('ffchistory');
        Schema::connection('rt3')->drop('fica');
        Schema::connection('rt3')->drop('ficastatus');
        Schema::connection('rt3')->drop('filelibrary');
        Schema::connection('rt3')->drop('financialinstitution');
        Schema::connection('rt3')->drop('fnb');
        Schema::connection('rt3')->drop('fnbstats');
        Schema::connection('rt3')->drop('franchise');
        Schema::connection('rt3')->drop('franchiseaward');
        Schema::connection('rt3')->drop('franchisebusinesstype');
        Schema::connection('rt3')->drop('franchiseclassification');
        Schema::connection('rt3')->drop('franchiseconsultants');
        Schema::connection('rt3')->drop('franchisefilelibrary');
        Schema::connection('rt3')->drop('franchisehistory');
        Schema::connection('rt3')->drop('franchisestatus');
        Schema::connection('rt3')->drop('iol');
        Schema::connection('rt3')->drop('jobtitle');
        Schema::connection('rt3')->drop('languagepreference');
        Schema::connection('rt3')->drop('lease');
        Schema::connection('rt3')->drop('leaseprocess');
        Schema::connection('rt3')->drop('leaseprocessstatus');
        Schema::connection('rt3')->drop('leasestatus');
        Schema::connection('rt3')->drop('listingaccess');
        Schema::connection('rt3')->drop('listingweb');
        Schema::connection('rt3')->drop('mandatetype');
        Schema::connection('rt3')->drop('maritalstatus');
        Schema::connection('rt3')->drop('municipalarea');
        Schema::connection('rt3')->drop('municipalareadefinition');
        Schema::connection('rt3')->drop('office');
        Schema::connection('rt3')->drop('officestatus');
        Schema::connection('rt3')->drop('othersuspcondition');
        Schema::connection('rt3')->drop('p24');
        Schema::connection('rt3')->drop('p24stakeholder');
        Schema::connection('rt3')->drop('p24stats');
        Schema::connection('rt3')->drop('p24stats_with_dupes');
        Schema::connection('rt3')->drop('p24suburbs');
        Schema::connection('rt3')->drop('person');
        Schema::connection('rt3')->drop('personagentlist');
        Schema::connection('rt3')->drop('personbuyerlist');
        Schema::connection('rt3')->drop('personhistory');
        Schema::connection('rt3')->drop('personrental');
        Schema::connection('rt3')->drop('personsales');
        Schema::connection('rt3')->drop('personsalestype');
        Schema::connection('rt3')->drop('personsellerlist');
        Schema::connection('rt3')->drop('personsellerlistreferral');
        Schema::connection('rt3')->drop('personsource');
        Schema::connection('rt3')->drop('pgenie');
        Schema::connection('rt3')->drop('pjunction');
        Schema::connection('rt3')->drop('postalcode');
        Schema::connection('rt3')->drop('property');
        Schema::connection('rt3')->drop('propertyactivity');
        Schema::connection('rt3')->drop('propertyfeatures');
        Schema::connection('rt3')->drop('propertyfeaturescategory');
        Schema::connection('rt3')->drop('propertyfeaturesdescription');
        Schema::connection('rt3')->drop('propertyhistory');
        Schema::connection('rt3')->drop('propertyimageref');
        Schema::connection('rt3')->drop('propertymeasurements');
        Schema::connection('rt3')->drop('propertytitletype');
        Schema::connection('rt3')->drop('propertytype');
        Schema::connection('rt3')->drop('propertytypebusinesstype');
        Schema::connection('rt3')->drop('province');
        Schema::connection('rt3')->drop('rapactivity');
        Schema::connection('rt3')->drop('rapactivityplan');
        Schema::connection('rt3')->drop('rapactivityplansellerlist');
        Schema::connection('rt3')->drop('rapcategory');
        Schema::connection('rt3')->drop('rapcycle');
        Schema::connection('rt3')->drop('rapcyclemanagement');
        Schema::connection('rt3')->drop('ratesperiod');
        Schema::connection('rt3')->drop('rawsonarea');
        Schema::connection('rt3')->drop('rawsonareadefinition');
        Schema::connection('rt3')->drop('rawsoncoza');
        Schema::connection('rt3')->drop('rawsonmutualexclusiveoffices');
        Schema::connection('rt3')->drop('rawsonsuburbs');
        Schema::connection('rt3')->drop('referencetype');
        Schema::connection('rt3')->drop('rental');
        Schema::connection('rt3')->drop('rentalprocess');
        Schema::connection('rt3')->drop('rentalprocessstatus');
        Schema::connection('rt3')->drop('rentalservices');
        Schema::connection('rt3')->drop('rentalservicesrequired');
        Schema::connection('rt3')->drop('rentalstatus');
        Schema::connection('rt3')->drop('rentaltype');
        Schema::connection('rt3')->drop('rep_achiever_detail_2016');
        Schema::connection('rt3')->drop('rep_achiever_detail');
        Schema::connection('rt3')->drop('rep_rap_detail');
        Schema::connection('rt3')->drop('rep_sales_days_to_market');
        Schema::connection('rt3')->drop('rep_sales_detail');
        Schema::connection('rt3')->drop('replication');
        Schema::connection('rt3')->drop('sale');
        Schema::connection('rt3')->drop('saleactivity');
        Schema::connection('rt3')->drop('saleexternalagency');
        Schema::connection('rt3')->drop('salefilelibrary');
        Schema::connection('rt3')->drop('salehistory');
        Schema::connection('rt3')->drop('salelead');
        Schema::connection('rt3')->drop('saleofficereferral');
        Schema::connection('rt3')->drop('saleotherservicesoption');
        Schema::connection('rt3')->drop('salesalestatus');
        Schema::connection('rt3')->drop('salestatus');
        Schema::connection('rt3')->drop('seller_referals_summary');
        Schema::connection('rt3')->drop('sellerlist');
        Schema::connection('rt3')->drop('sellerlistactivity');
        Schema::connection('rt3')->drop('sellerlisthistory');
        Schema::connection('rt3')->drop('sellerlistimageref');
        Schema::connection('rt3')->drop('sellerlistreferral');
        Schema::connection('rt3')->drop('sellerlistreferralactivity');
        Schema::connection('rt3')->drop('sellerlistreferralhistory');
        Schema::connection('rt3')->drop('sellerlistreferralstatus');
        Schema::connection('rt3')->drop('sellerliststatus');
        Schema::connection('rt3')->drop('sellerliststatushistory');
        Schema::connection('rt3')->drop('serviceprovidertype');
        Schema::connection('rt3')->drop('showhouseagents');
        Schema::connection('rt3')->drop('showhouselog');
        Schema::connection('rt3')->drop('stakeholder_ffchistory');
        Schema::connection('rt3')->drop('stakeholder');
        Schema::connection('rt3')->drop('stakeholderdirectors');
        Schema::connection('rt3')->drop('stakeholderstatus');
        Schema::connection('rt3')->drop('stakeholdertype');
        Schema::connection('rt3')->drop('subjecttosale');
        Schema::connection('rt3')->drop('suburb');
        Schema::connection('rt3')->drop('tenant');
        Schema::connection('rt3')->drop('tenantareas');
        Schema::connection('rt3')->drop('tenantcreditcheckoptions');
        Schema::connection('rt3')->drop('tenantreference');
        Schema::connection('rt3')->drop('tenantsellerlist');
        Schema::connection('rt3')->drop('tenantstatus');
        Schema::connection('rt3')->drop('tenantsuburbs');
        Schema::connection('rt3')->drop('title');
        Schema::connection('rt3')->drop('trading_times');
        Schema::connection('rt3')->drop('tradingentity');
        Schema::connection('rt3')->drop('tradingentityperson');
        Schema::connection('rt3')->drop('tradingentityserviceprovider');
        Schema::connection('rt3')->drop('tradingentitytype');
        Schema::connection('rt3')->drop('webservice_mappings');
    }
}
