Ext.define('darkowl.userManager.setup.window.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : 'Setup',
    iconCls : 'window-create-db-icon',
    layout : 'fit',
    m_arr_DatabaseURIs : [],
    m_str_Output : '',
    requires :
    [ 'Ext.Ajax' ],
    initComponent : function()
    {
	    this.callParent();
	    this.log("Starting setup...");
	    this.getDatabases();

    },
    log : function(str_Data)
    {
	    this.m_str_Output += str_Data + "<br/>\n";
	    this.update(this.m_str_Output);
    },
    logError : function(str_Data)
    {
	    this.m_str_Output += "<b>" + str_Data + "</b><br/>\n";
	    this.update(this.m_str_Output);
    },
    getDatabases : function()
    {
	    this.log("Getting Database Data...");

	    desktop.logger.log("URL - " + g_obj_Config.m_str_BaseURL
	            + '/rest/setup/');
	    Ext.Ajax.request(
	    {
	        url : g_obj_Config.m_str_BaseURL + '/rest/setup/',
	        params :
	        {
		        action : "create"
	        },
	        headers :
	        {
		        Accept : "application/json"
	        },
	        success : function(response)
	        {
		        this.log("Retrieved Database URI(s)...");
		        var obj_Response = Ext.decode(response.responseText);
		        this.getTables(obj_Response);
	        },
	        failure : this.failure,
	        scope : this
	    });
    },
    failure : function(obj_Response, str_Msg)
    {
	    if (!str_Msg || typeof str_Msg != "string")
	    {
		    str_Msg = "Failed for the following reason(s)...";
	    }
	    this.logError(str_Msg);
	    try
	    {
		    var obj_Response = Ext.decode(response.responseText);

		    if (obj_Response.errors)
		    {
			    for (int_Key in obj_Response.errors)
			    {
				    this.logError("&nbsp; -" + (parseInt(int_Key) + 1) + ") "
				            + obj_Response.errors[int_Key]);
			    }
		    }
	    }
	    catch (e)
	    {
		    this
		            .logError("&nbsp; - Failed to return data. ("
		                    + obj_Response.status + " "
		                    + obj_Response.statusText + ")");
	    }
    },
    getTables : function(obj_Response)
    {
	    if (obj_Response.resources)
	    {
		    for (int_Key in obj_Response.resources)
		    {
			    this.m_arr_DatabaseURIs.push(
			    {
			        name : obj_Response.resources[int_Key].name,
			        uri : obj_Response.resources[int_Key].uri
			    });
		    }
	    }
	    if (this.m_arr_DatabaseURIs[0])
	    {
		    this.getTableData(this.m_arr_DatabaseURIs[0].name,
		            this.m_arr_DatabaseURIs[0].uri);
	    }
    },
    getTableData : function(str_Name, str_URI)
    {
	    this.log("Getting information for the <b>" + str_Name
	            + "</b> database ...");
	    desktop.logger.log("URL - " + g_obj_Config.m_str_BaseURL + "/"
	            + str_URI);
	    Ext.Ajax.request(
	    {
	        url : g_obj_Config.m_str_BaseURL + "/" + str_URI,
	        params :
	        {
		        action : "create"
	        },
	        headers :
	        {
		        Accept : "application/json"
	        },
	        success : function(response)
	        {
		        this.log("Retrieved Database URI(s)...");
		        var obj_Response = Ext.decode(response.responseText);
		        this.getTables(obj_Response);
	        },
	        failure : this.failure,
	        scope : this
	    });
    }
});
