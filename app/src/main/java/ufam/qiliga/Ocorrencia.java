package ufam.qiliga;

import java.io.Serializable;

public class Ocorrencia implements Serializable{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private int idOcorrencia;
	private float latitude;
	private float longitude;
	private int nNotificacoes;
	private String status;
	private String situacao;
	private String ruaPoste;
	
	public Ocorrencia()
	{
		
	}
	
	public Ocorrencia(float latitude, float longitude, int nNotificacoes, String status, String ruaPoste)
	{
		//this.idUsuario = idUsuario;
		this.latitude = latitude;
		this.longitude = longitude;
		this.nNotificacoes = nNotificacoes;
		this.status = status;
		this.ruaPoste = ruaPoste;
		
	}

	public int getIdOcorrencia() {
		return idOcorrencia;
	}

	public void setIdOcorrencia(int idUsuario) {
		this.idOcorrencia = idUsuario;
	}

	public float getLatitude() {
		return latitude;
	}

	public void setLatitude(float latitude) {
		this.latitude = latitude;
	}

	public float getLongitude() {
		return longitude;
	}

	public void setLongitude(float longitude) {
		this.longitude = longitude;
	}

	public int getnNotificacoes() {
		return nNotificacoes;
	}

	public void setnNotificacoes(int nNotificacoes) {
		this.nNotificacoes = nNotificacoes;
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.status = status;
	}

	public String getRuaPoste() {
		return ruaPoste;
	}

	public void setRuaPoste(String ruaPoste) {
		this.ruaPoste = ruaPoste;
	}
	
	public String getSituacao() {
		return situacao;
	}

	public void setSituacao(String situacao) {
		this.situacao = situacao;
	}

}
