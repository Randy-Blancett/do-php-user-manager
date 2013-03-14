Ext.define('darkowl.userManager.setup.database.cUserManagerInterface',
{
    singleton : true,
    create : function(outputFunction,successFunction)
    {
	    Ext.Ajax
	            .request(
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
	                	outputFunction("Retrieved Database URI(s)...");
		                var obj_Response = this
		                        .validateResponse(response.responseText);
		                if (obj_Response)
		                {
			                this.getTables(obj_Response);
		                }
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
});