package com.globallogic.aidriven.hooks;

import java.nio.file.Files;
import java.nio.file.Path;

final class EvidencePaths {
  private EvidencePaths() {}

  static Path screenshotDir() throws Exception {
    Path root = Path.of(System.getProperty("stlc.evidence.dir", "target/stlc-evidence"));
    Path dir = root.resolve("screenshots");
    Files.createDirectories(dir);
    return dir;
  }

  static Path videoDir() throws Exception {
    Path root = Path.of(System.getProperty("stlc.evidence.dir", "target/stlc-evidence"));
    Path dir = root.resolve("videos");
    Files.createDirectories(dir);
    return dir;
  }
}
