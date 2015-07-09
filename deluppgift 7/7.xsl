<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	
	<xsl:template match="newspapers">
		<xsl:for-each select="newspaper">	
			<xsl:sort select="@subscribers" order="descending"/>
			<tr>
			<td rowspan="3"><xsl:value-of select="@name"/></td> <!-- rowspan=3 skulle kunna bytas ut mot en count för antal artiklar. <xsl:value-of select="count(./*)"/> -->
			<td rowspan="3"><xsl:value-of select="@subscribers"/></td>
			<td rowspan="3"><xsl:value-of select="@type"/></td>
			<xsl:apply-templates/>
			</tr>
		</xsl:for-each>
	</xsl:template>
	
	<xsl:template match="article[position()=1]">
			<td><xsl:value-of select="./@id"/></td>
			<xsl:choose>
				<xsl:when test="count(./@*)!=2">
					<td style="color:grey"><div align="center">no date</div></td>
				</xsl:when>
				<xsl:otherwise>
					<td><xsl:value-of select="./@time"/></td>
				</xsl:otherwise>
			</xsl:choose>
			<xsl:apply-templates/>
			<xsl:choose>
				<xsl:when test="count(./*)=3">
					<td><xsl:value-of select="./comment/@description"/></td>
				</xsl:when>
				<xsl:otherwise>
					<td style="color:grey"><div align="center">no info</div></td>
				</xsl:otherwise>
			</xsl:choose>
	</xsl:template>

	<xsl:template match="article[position()>1]">
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
			<xsl:apply-templates/>
			<xsl:choose>
				<xsl:when test="count(./*)=3">
					<td><xsl:value-of select="./comment/@description"/></td>
				</xsl:when>
				<xsl:otherwise>
					<td style="color:grey"><div align="center">no info</div></td>
				</xsl:otherwise>
			</xsl:choose>
		</tr>
	</xsl:template>
	
	<xsl:template match="heading">
		<td><xsl:value-of select="."/></td>
	</xsl:template>
	
	<xsl:template match="text">
		<td><xsl:value-of select="."/></td>
	</xsl:template>
	
</xsl:stylesheet>