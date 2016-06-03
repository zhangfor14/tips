select id, user,temp.email_163
from
(
select id,user,
case 
        when substr(email,-7,4)='163.' then substr(email,-7)
        when substr(email,-6,4)='163.' then substr(email,-6)
        when substr(email,-10,4)='163.' then substr(email,-10)
        
else '0' end email_163
from user_copy
)as temp
where temp.email_163 != '0';