package com.ssg.cg.common;
import java.util.HashMap;
import java.util.List;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;
import com.ssg.cg.common.Test3Mapper;
import com.ssg.cg.utl.StdResDomain;
import com.ssg.cg.utl.StdReqDomain;
import com.ssg.cg.utl.StdUtil;
@Service
public class Test3Service{
	static Logger logger = Logger.getLogger(Test3Service.class);
	
	@Autowired
	private Test3Mapper test3Mapper; 
	
	@Autowired
	private StdResDomain resDomain; 
	
	private HashMap<String,String> sqlMap;
//그룹별 키 컬럼ID	private String G1_KEYCOLID = "";
	private String G4_KEYCOLID = "";
	private String G2_KEYCOLID = "CC";
	private String G3_KEYCOLID = "A";
	/*METHOD START*/	/*SVC START*/
	//버튼G1 NEW
	public StdResDomain G1_NEW(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G1_NEW()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//버튼G1 BTNCLICK
	public StdResDomain G1_BTNCLICK(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G1_BTNCLICK()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//버튼G1 MODIFY
	public StdResDomain G1_MODIFY(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G1_MODIFY()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//버튼G1 SAVE
	public StdResDomain G1_SAVE(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G1_SAVE()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//버튼G1 DELETE
	public StdResDomain G1_DELETE(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G1_DELETE()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//컨디션G2 SEARCHALL
	public StdResDomain G2_SEARCHALL(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G2_SEARCHALL()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 SEARCH
	public StdResDomain G3_SEARCH(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_SEARCH()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		StdReqDomain G3_reqDomain = new StdReqDomain();
		StdReqDomain G2_reqDomain = new StdReqDomain();
		try{
			G3_reqDomain = (StdReqDomain) userParams.get("G3_DATA");
			G2_reqDomain = (StdReqDomain) userParams.get("G2_DATA");
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/

		//그리드 SEARCH
		resDomain.addGridReadRTN_DATA("G3", "", new String[]{"A","B","C"} , test3Mapper.selectUserList(params));
		//그리드 SEARCH
		resDomain.addGridReadRTN_DATA("G2", "", new String[]{"CC","BB","AA"} , test3Mapper.selectUserList(params));		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 EXCEL
	public StdResDomain G3_EXCEL(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_EXCEL()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 ROWADD
	public StdResDomain G3_ROWADD(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_ROWADD()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 SAVE
	public StdResDomain G3_SAVE(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_SAVE()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		StdReqDomain G3_reqDomain = new StdReqDomain();
		StdReqDomain G2_reqDomain = new StdReqDomain();
		try{
			G3_reqDomain = (StdReqDomain) userParams.get("G3_DATA");
			G2_reqDomain = (StdReqDomain) userParams.get("G2_DATA");
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
//그리드 SAVE
		logger.info("##### SVCGRP : G3 ##### size : " + String.valueOf(G3_reqDomain.getRows().size()));
		for(int i=0;i<G3_reqDomain.getRows().size();i++){
			logger.info("     i : " + String.valueOf(i));
			sqlMap = new HashMap<String,String>(params); //기본 파라미터를 기준으로 생성
			sqlMap.putAll(G3_reqDomain.getCellsMap(i)); //해당 row의 cell 정보가져오기
			logger.info(String.valueOf(i) + "번째  " + G3_reqDomain.getRows().get(i).get("!nativeeditor_status").toString());
			switch(	G3_reqDomain.getRows().get(i).get("!nativeeditor_status").toString() ){



				case "deleted":
					resDomain.addGridSaveRTN_DATA("G3",G3_KEYCOLID,G3_reqDomain.getRows().get(i).get("row id").toString(),G3_reqDomain.getRows().get(i).get("row id").toString()
							, "deleted", test3Mapper.deleteUser(sqlMap) );
					break;
				default :
					logger.info("	!nativeeditor_status 가 정의되지 않았습니다.");
					break;				
			}
		}
//그리드 SAVE
		logger.info("##### SVCGRP : G2 ##### size : " + String.valueOf(G2_reqDomain.getRows().size()));
		for(int i=0;i<G2_reqDomain.getRows().size();i++){
			logger.info("     i : " + String.valueOf(i));
			sqlMap = new HashMap<String,String>(params); //기본 파라미터를 기준으로 생성
			sqlMap.putAll(G2_reqDomain.getCellsMap(i)); //해당 row의 cell 정보가져오기
			logger.info(String.valueOf(i) + "번째  " + G2_reqDomain.getRows().get(i).get("!nativeeditor_status").toString());
			switch(	G2_reqDomain.getRows().get(i).get("!nativeeditor_status").toString() ){



				case "inserted":									
					int affected_rows = 0;
					logger.info("11111 row id: " + G2_reqDomain.getRows().get(i).get("row id").toString());
					affected_rows = test3Mapper.insertUser(sqlMap);
					logger.info("22222 affected_rows: " + String.valueOf(affected_rows));
					logger.info("22222 newid: " + String.valueOf(sqlMap.get("newid")));
					resDomain.addGridSaveRTN_DATA("G2",G2_KEYCOLID,G2_reqDomain.getRows().get(i).get("row id").toString(),String.valueOf(sqlMap.get("newid"))
							, "inserted", affected_rows );
					logger.info("33333 : ");					
					break;
				case "updated":
					resDomain.addGridSaveRTN_DATA("G2",G2_KEYCOLID,G2_reqDomain.getRows().get(i).get("row id").toString(),G2_reqDomain.getRows().get(i).get("row id").toString()
							, "updated",  test3Mapper.updateUser(sqlMap));
					break;
				case "deleted":
					resDomain.addGridSaveRTN_DATA("G2",G2_KEYCOLID,G2_reqDomain.getRows().get(i).get("row id").toString(),G2_reqDomain.getRows().get(i).get("row id").toString()
							, "deleted", test3Mapper.deleteUser(sqlMap) );
					break;
				default :
					logger.info("	!nativeeditor_status 가 정의되지 않았습니다.");
					break;				
			}
		}
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 USERDEF
	public StdResDomain G3_USERDEF(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_USERDEF()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 RELOAD
	public StdResDomain G3_RELOAD(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_RELOAD()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
	/*SVC START*/
	//그리드G3 ROWDELETE
	public StdResDomain G3_ROWDELETE(HashMap<String, String> params, HashMap<String,Object> userParams) {
		logger.info("Test3Service-------------------------------G3_ROWDELETE()");
		resDomain = new StdResDomain();
//REQ 도메인 정의
		try{
		}catch(Exception e){
			logger.info("사용자 파리미터 수신시 null : " + e.getMessage());
		}
		/*SVC OBJ LOOP*/
		resDomain.setRTN_CD("200");
		resDomain.setERR_CD("200");
		resDomain.setRTN_MSG("감사합니다.");		
		return resDomain;
	}
}
