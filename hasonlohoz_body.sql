create or replace PACKAGE BODY HASONLOHOZ AS
PROCEDURE hasonlo (
    keres IN VIDEOK.LINK%Type,
   keres_cursor OUT cursorType
    )
AS 
BEGIN
     
     OPEN keres_cursor FOR
    SELECT DISTINCT LINK from
    (SELECT videok.link from VIDEOK where kategoria like '%'||keres||'%'
    UNION 
    SELECT distinct videok.link from VIDEOK where cim like '%' || keres || '%'
    UNION
    SELECT distinct cimkek.link from CIMKEK where cimke like '%' || keres || '%' );
     
  
    END hasonlo;
END HASONLOHOZ;