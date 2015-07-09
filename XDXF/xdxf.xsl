<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	
	<xsl:template match="xdxf">
		<xsl:apply-templates/>
		<table width="300"> <!-- Denna tabell skriver ut förkortningarnas betydelse nedanför den stora tabellen -->
			<tr>
				<td class='about' colspan="6"><xsl:value-of select ="name(./abbreviations)"/></td>
			</tr>
			<tr>
				<xsl:for-each select="./abbreviations/abr_def">
				<xsl:sort select="./k" order="ascending"/> <!-- Denna rad används för att sortera förkortningarna i bokstavsordning -->
					<td><xsl:value-of select="./k"/></td><td><xsl:value-of select="./v"/></td>
				</xsl:for-each>
			</tr></table>
	</xsl:template>
	
	<xsl:template match="full_name"> <!-- Skriver ut rubriken på tabellen -->
		<tr>
			<th class='heading' colspan="6">
					<xsl:value-of select="."/>
			</th>
		</tr>
	</xsl:template>
	
	<xsl:template match="description"> <!-- Skriver ut underrubriken på tabellen och hårdkodar sedan kolumnerna -->
		<tr>
			<td class='about' colspan="6">
				<xsl:value-of select="."/>
			</td>
		</tr>
		<tr>
			<th>word</th>
			<th>phonetic</th>
			<th>type</th>
			<th width="300">definition</th>
			<th>example</th>
			<th>soundfile</th>
		</tr>
	</xsl:template>
	
	<xsl:template match="ar[count(./k/opt)>=1]"> <!-- Plockar fram den första udda ar som innehåller taggen opt i k, och gör absolut ingenting med den -->
		
	</xsl:template>
	
	<xsl:template match="ar[count(./@f)=1]"> <!-- Om ar har ett attribut som heter f görs detta. Dett gäller alltså för [houm]. -->
		<tr>
			<td class="word"><xsl:value-of select="./k"/></td> <!-- Skriver ut ordet -->
			<td align="center">[<xsl:value-of select="./tr"/>]</td> <!-- Skriver ut fonetiken -->
			<td align="center"><xsl:value-of select="./pos/abr"/></td> <!-- Skriver ut förkortningen -->
			<td>
				<xsl:for-each select="./def"> <!-- Skriver ut alla definitioner med sitt ordningsnr följt av ) först -->
					<xsl:value-of select="position()"/>) <xsl:value-of select="."/><br/>
				</xsl:for-each>
			</td>
			<td><xsl:value-of select="./def/ex"/></td> <!-- Skriver ut en exempelmening -->
			<td align="center"><xsl:value-of select="./rref"/><br/>filesize: <xsl:value-of select="./rref/@size"/>kB</td> <!-- Skriver ut ljudfilen -->
		</tr>
	</xsl:template>
	
	<xsl:template match="ar"> <!-- Plockar fram ordinarie ar -->
		<tr>
			<td class="word"><xsl:value-of select="./k"/></td> <!-- Skriver ut ordet -->
			
			<xsl:choose>  <!-- Skriver ut fonetiken om den finns, i annat fall talar den om att det inte finns -->
				<xsl:when test="count(./tr)=0">
					<td align="center" class="no">no<br/>phonetic</td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center">[<xsl:value-of select="./tr"/>]</td>
				</xsl:otherwise>
			</xsl:choose>
			
			<xsl:choose>  <!-- Skriver ut förkortningen om den finns, i annat fall talar den om att den inte finns -->
				<xsl:when test="count(./pos/abr)=0">
					<td align="center" class="no">no<br/>type</td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center"><xsl:value-of select="./pos/abr"/></td>
				</xsl:otherwise>
			</xsl:choose>
			
			<td> <!-- Kallar på en template som städar och sedan skriver ut alla definitioner -->
				<xsl:for-each select="text()">
					<xsl:call-template name="clean"/>
				</xsl:for-each>
			</td>
			
			<xsl:choose> <!-- Skriver ut ett exempel om det finns, i annat fall talar den om att det inte finns -->
				<xsl:when test="count(./ex)=0">
					<td align="center" class="no">no example found</td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center"><xsl:value-of select="./ex"/></td>
				</xsl:otherwise>
			</xsl:choose>
			
			<xsl:choose> <!-- Skriver ut namn på ljudfil om det finns, i annat fall tom cell -->
				<xsl:when test="count(./rref)=0">
					<td align="center" class="no">no sound found</td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center"><xsl:value-of select="./rref"/><br/>filesize: <xsl:value-of select="./rref/@size"/>kB</td>
				</xsl:otherwise>
			</xsl:choose>
		</tr>
	</xsl:template>
	
	<xsl:template name="clean"> <!-- Denna template städar definitionstexterna på oönskade tecken -->
		<xsl:param name="text" select="."/>
		<xsl:choose>
		<xsl:when test="contains($text, '&#x5b;')"> <!-- Denna when plockar bort tecknet '[' -->
			<xsl:value-of select="substring-before($text, '&#x5b;')"/>
			<xsl:call-template name="clean">
				<xsl:with-param name="text" select="substring-after($text,'&#x5b;')"/>
			</xsl:call-template>
		</xsl:when>
		<xsl:when test="contains($text, '&#x5d;')"> <!-- Denna when plockar bort tecknet ']' -->
			<xsl:value-of select="substring-before($text, '&#x5d;')"/>
			<xsl:call-template name="clean">
				<xsl:with-param name="text" select="substring-after($text,'&#x5d;')"/>
			</xsl:call-template>
		</xsl:when>
		<xsl:when test="contains($text, '&#x2e;')"> <!-- Denna when ser till så att det blir en ny rad efter varje punkt, dvs. före varje ny definition -->
			<xsl:value-of select="substring-before($text, '&#x2e;')"/>.<br/>
			<xsl:call-template name="clean">
				<xsl:with-param name="text" select="substring-after($text,'&#x2e;')"/>
			</xsl:call-template>
		</xsl:when>
		<xsl:when test="contains($text, 'See also:')"> <!-- Denna when plockar bort uttrycket "See also:" -->
			<xsl:value-of select="substring-before($text, 'See also:')"/>
			<xsl:call-template name="clean">
				<xsl:with-param name="text" select="substring-after($text,'See also:')"/>
			</xsl:call-template>
		</xsl:when>
		<xsl:otherwise>
			<xsl:value-of select="$text"/>
		</xsl:otherwise>
		</xsl:choose>
	</xsl:template>

	<xsl:template match="abbreviations"> <!-- Gör så att inte innehållet i abbrevationstaggens skrivs ut högst upp på sidan. -->
	</xsl:template>
	
</xsl:stylesheet>