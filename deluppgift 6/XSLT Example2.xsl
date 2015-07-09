<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match="/"> <!-- Talar om att jag vill utgå från rotnoden -->
		<xsl:for-each select="./newspapers/newspaper"> <!-- Jag använder en foreach för varje tidning så att all information buntas ihop -->
			<xsl:for-each select="./article"> <!-- Eftersom jag inte vill ha brutna taggar måste jag gå ner ytterligare ett steg i trädet-->
				<xsl:choose>
					<xsl:when test="position()=1"> <!-- Denna rad ser till att tidningsnamnet skrivs ut med rowspan 3 endast på första artikeln -->
						<tr>
							<td rowspan="3"><xsl:value-of select="../@name"/></td>	<!-- All tidningsinfo listas på dessa 3 rader -->
							<td rowspan="3"><xsl:value-of select="../@subscribers"/></td>
							<td rowspan="3"><xsl:value-of select="../@type"/></td>
							<td><xsl:value-of select="./@id"/></td> <!-- Här listas artikelns id-nr. -->
							<xsl:choose>
								<xsl:when test="count(./@*)!=2"> <!-- Om article inte har två attribut betyder det att datumet saknas och då skrivs no date -->
									<td style="color:grey"><div align="center">no date</div></td>
								</xsl:when>
								<xsl:otherwise>
									<td><xsl:value-of select="./@time"/></td> <!-- I annat fall, datumet -->
								</xsl:otherwise>
							</xsl:choose>
							<td><xsl:value-of select="./heading"/></td> <!-- Artikelns heading och text listas -->
							<td><xsl:value-of select="./text"/></td>
							<xsl:choose>
								<xsl:when test="count(./*)=3"> <!-- Om article har 3 undertaggar betyder det att comment finns -->
									<td><xsl:value-of select="./comment/@description"/></td> <!-- Isf skrivs beskrivningen ut -->
								</xsl:when>
								<xsl:otherwise>
									<td style="color:grey"><div align="center">no info</div></td> <!-- I annat fall no info -->
								</xsl:otherwise>
							</xsl:choose>
						</tr>
					</xsl:when>
					<xsl:otherwise> <!-- Om artikeln inte är först iordning skrivs inte tidningsnamnet ut, men i övrigt är resten likadant -->
						<tr>
							<td><xsl:value-of select="./@id"/></td>
							<xsl:choose>
								<xsl:when test="count(./@*)!=2">
									<td style="color:grey"><div align="center">no date</div></td>
								</xsl:when>
								<xsl:otherwise>
									<td><xsl:value-of select="./@time"/></td>
								</xsl:otherwise>
							</xsl:choose>
							<td><xsl:value-of select="./heading"/></td>
							<td><xsl:value-of select="./text"/></td>
							<xsl:choose>
								<xsl:when test="count(./*)=3">
									<td><xsl:value-of select="./comment/@description"/></td>
								</xsl:when>
								<xsl:otherwise>
									<td style="color:grey"><div align="center">no info</div></td>
								</xsl:otherwise>
							</xsl:choose>
						</tr>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:for-each>	
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>