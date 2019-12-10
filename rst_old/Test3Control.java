package com.ssg.cg.common; // TEST3
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.Enumeration;
import java.util.List;
import java.util.Map;
import java.util.ArrayList;
import java.util.HashMap;

import javax.annotation.PostConstruct;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired; 
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RequestParam;

import com.fasterxml.jackson.core.JsonParseException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.SerializationFeature;
import com.fasterxml.jackson.databind.node.ObjectNode;
import com.ssg.cg.common.Test3Service;
import com.ssg.cg.utl.StdReqDomain;
import com.ssg.cg.utl.StdResDomain;
import com.ssg.cg.utl.StdUtil;

@Controller
public class Test3Controller {
	static Logger logger = Logger.getLogger(Test3Controller.class);
	@Autowired
	private Test3Service test3Service;
	private HashMap<String,Object> userParams;
	private StdUtil stdUtil;	@PostConstruct
	public void init(){
		stdUtil = new StdUtil();
		logger.info("Test3Controller--------------init()");
	}	//Method start (grp)
	//Method start (fnc)
	@RequestMapping("/common/TEST3/G1_SAVE.cg")
	public @ResponseBody
	StdResDomain G1_SAVE(HttpServletRequest request,@RequestParam HashMap<String, String> params) {
		//외부 입력값 로그 출력
		stdUtil.viewRequest(request);
		userParams = new HashMap<String,Object>(); 
		return test3Service.G1_SAVE(params,userParams);
	}
	//Method start (fnc)
	//Method start (fnc)
	//Method start (fnc)
	@RequestMapping("/common/TEST3/G3_USERDEF.cg")
	public @ResponseBody
	StdResDomain G3_USERDEF(HttpServletRequest request,@RequestParam HashMap<String, String> params) {
		//외부 입력값 로그 출력
		stdUtil.viewRequest(request);
		userParams = new HashMap<String,Object>(); 
		return test3Service.G3_USERDEF(params,userParams);
	}
	@RequestMapping("/common/TEST3/G3_SEARCH.cg")
	public @ResponseBody
	StdResDomain G3_SEARCH(HttpServletRequest request,@RequestParam HashMap<String, String> params) {
		//외부 입력값 로그 출력
		stdUtil.viewRequest(request);
		userParams = new HashMap<String,Object>(); 
		userParams.put("G3_DATA",stdUtil.getReqDomain(params.get("G3_jsondata")));
		userParams.put("G2_DATA",stdUtil.getReqDomain(params.get("G2_jsondata")));
		return test3Service.G3_SEARCH(params,userParams);
	}
	@RequestMapping("/common/TEST3/G3_SAVE.cg")
	public @ResponseBody
	StdResDomain G3_SAVE(HttpServletRequest request,@RequestParam HashMap<String, String> params) {
		//외부 입력값 로그 출력
		stdUtil.viewRequest(request);
		userParams = new HashMap<String,Object>(); 
		userParams.put("G3_DATA",stdUtil.getReqDomain(params.get("G3_jsondata")));
		userParams.put("G2_DATA",stdUtil.getReqDomain(params.get("G2_jsondata")));
		return test3Service.G3_SAVE(params,userParams);
	}
	@RequestMapping("/common/TEST3/G3_EXCEL.cg")
	public @ResponseBody
	StdResDomain G3_EXCEL(HttpServletRequest request,@RequestParam HashMap<String, String> params) {
		//외부 입력값 로그 출력
		stdUtil.viewRequest(request);
		userParams = new HashMap<String,Object>(); 
		return test3Service.G3_EXCEL(params,userParams);
	}
}
