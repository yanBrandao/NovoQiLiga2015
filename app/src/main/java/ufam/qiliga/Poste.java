package ufam.qiliga;

public class Poste {

	int id;
	float latitude, longitude;
	String statusDia, statusNoite;
	
	public Poste(){}
	
	public Poste(int id, float latitude, float longitude, String statusDia,
			String statusNoite) {
		this.id = id;
		this.latitude = latitude;
		this.longitude = longitude;
		this.statusDia = statusDia;
		this.statusNoite = statusNoite;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
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

	public String getStatusDia() {
		return statusDia;
	}

	public void setStatusDia(String statusDia) {
		this.statusDia = statusDia;
	}

	public String getStatusNoite() {
		return statusNoite;
	}

	public void setStatusNoite(String statusNoite) {
		this.statusNoite = statusNoite;
	}
	
	
	
	
	
}
